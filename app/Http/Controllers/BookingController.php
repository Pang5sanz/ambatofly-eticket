<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    // Menampilkan halaman detail sebelum memesan
    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('user.booking_detail', compact('schedule'));
    }

    // Memproses pesanan ke database
    public function store(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $request->validate([
            'total_seats' => 'required|integer|min:1|max:' . $schedule->stock,
            'passengers' => 'required|array|size:' . $request->total_seats,
            'passengers.*.name' => 'required|string',
            'passengers.*.email' => 'required|email',
            'passengers.*.phone' => 'required|string',
        ]);

        // Hitung total harga
        $total_price = $request->total_seats * $schedule->price;

        // Simpan ke tabel Bookings
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $schedule->id,
            'total_seats' => $request->total_seats,
            'total_price' => $total_price,
            'status' => 'pending',
            'passenger_details' => json_encode($request->passengers)
        ]);

        // Kurangi stok di tabel schedules
        $schedule->decrement('stock', $request->total_seats);

        // Kembali ke dashboard
        return redirect('/checkout/' . $booking->id);
    }

    // Menampilkan halaman checkout
    public function checkout($booking_id)
    {
        $booking = Booking::with('schedule', 'user')->findOrFail($booking_id);

        // Pastikan booking milik user yang login
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Jika booking sudah dikonfirmasi, redirect ke history
        if ($booking->status === 'success') {
            return redirect('/history')->with('info', 'Pesanan Anda sudah dikonfirmasi.');
        }

        return view('user.checkout', compact('booking'));
    }

    // Memproses pembayaran
    public function processPayment(Request $request, $booking_id)
    {
        $booking = Booking::findOrFail($booking_id);

        // Pastikan booking milik user yang login
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Jika booking sudah dikonfirmasi, redirect
        if ($booking->status === 'success') {
            return redirect('/history')->with('info', 'Pesanan Anda sudah dikonfirmasi.');
        }

        $request->validate([
            'payment_method' => 'required|string',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cek apakah sudah ada payment yang completed
        if ($booking->payment && $booking->payment->status === 'completed') {
            return redirect('/history')->with('info', 'Pembayaran sudah diproses.');
        }

        // Upload file bukti pembayaran
        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            // Jika ada payment sebelumnya, hapus file lama
            if ($booking->payment && $booking->payment->payment_proof) {
                Storage::disk('public')->delete($booking->payment->payment_proof);
            }
            $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Simpan pembayaran (atau update jika sudah ada)
        $payment = $booking->payment ?? new Payment();
        $payment->booking_id = $booking->id;
        $payment->amount = $booking->total_price;
        $payment->payment_method = $request->payment_method;
        $payment->payment_account = null; // nomor rekening user tidak disimpan, gunakan nomor rekening admin di tampilan
        $payment->customer_name = $request->customer_name;
        $payment->customer_email = $request->customer_email;
        $payment->customer_phone = $request->customer_phone;
        $payment->status = 'completed';
        
        // Update payment proof hanya jika ada file baru
        if ($proofPath) {
            $payment->payment_proof = $proofPath;
        }
        
        $payment->payment_verification_status = 'pending';
        $payment->save();

        // Status booking tetap 'pending' hingga admin mengkonfirmasi
        // Tidak ada perubahan status di sini

        return redirect('/history')->with('success', 'Pembayaran berhasil! Menunggu verifikasi bukti pembayaran oleh admin.');
    }

    // Menampilkan riwayat pesanan user yang sedang login
    public function history()
    {
        $orders = Booking::where('user_id', Auth::id())
            ->with('schedule', 'payment')
            ->latest()
            ->get();

        return view('user.history', compact('orders'));
    }
}
