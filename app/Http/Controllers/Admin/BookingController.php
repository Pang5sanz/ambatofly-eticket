<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Melihat daftar semua pesanan dari semua user
    public function index()
    {
        // Mengambil data booking beserta relasi user dan schedule
        $bookings = Booking::with(['user', 'schedule', 'payment'])->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    // Konfirmasi pesanan
    public function confirm($id)
    {
        $booking = Booking::with('payment')->findOrFail($id);

        // Cek apakah booking sudah dibayar dan bukti pembayaran sudah diverifikasi
        if (!$booking->payment || $booking->payment->status !== 'completed') {
            return redirect()->back()->with('error', 'Pesanan belum dibayar.');
        }

        if ($booking->payment->payment_verification_status !== 'verified') {
            return redirect()->back()->with('error', 'Bukti pembayaran belum diverifikasi.');
        }

        $booking->status = 'success';
        $booking->save();

        return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    // Verifikasi bukti pembayaran
    public function verifyPayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->payment_verification_status = 'verified';
        $payment->save();

        return redirect()->back()->with('success', 'Bukti pembayaran telah diverifikasi.');
    }

    // Reject bukti pembayaran
    public function rejectPayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->payment_verification_status = 'rejected';
        $payment->save();

        return redirect()->back()->with('success', 'Bukti pembayaran ditolak. User dapat mengunggah ulang bukti pembayaran.');
    }
}