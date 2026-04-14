<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // PAGINATION (untuk card)
        $schedules = Schedule::where('stock', '>', 0)->latest()->paginate(10);
        $allSchedules = Schedule::where('stock', '>', 0)->get(); // Untuk stats

        return view('admin.dashboard', compact('schedules', 'allSchedules'));
    }

    public function report(Request $request)
    {
        $query = Booking::with(['user', 'schedule', 'payment']);

        // Filter berdasarkan tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $reports = $query->orderBy('created_at', 'desc')->get();

        // Untuk filter form
        $users = \App\Models\User::where('role', 'user')->get();

        return view('admin.report', compact('reports', 'users'));
    }

    public function generatePDF(Request $request)
    {
        $query = Booking::with(['user', 'schedule', 'payment']);

        // Filter berdasarkan tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $reports = $query->orderBy('created_at', 'desc')->get();

        // Hitung total
        $totalRevenue = $reports->sum('total_price');
        $totalBookings = $reports->count();
        $confirmedBookings = $reports->where('status', 'confirmed')->count();

        $pdf = \PDF::loadView('admin.report-pdf', compact('reports', 'totalRevenue', 'totalBookings', 'confirmedBookings'));

        return $pdf->download('report-transaksi-' . date('Y-m-d') . '.pdf');
    }
}