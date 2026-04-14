<?php

use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;


// Guest: Login & Register
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');

// Auth: Hanya untuk yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.index');
    Route::post('/booking/{id}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/checkout/{booking_id}', [BookingController::class, 'checkout'])->name('booking.checkout');
    Route::post('/checkout/{booking_id}', [BookingController::class, 'processPayment'])->name('booking.payment');
    Route::get('/history', [BookingController::class, 'history'])->name('booking.history');

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        Route::get('/admin/schedules/create', [AdminScheduleController::class, 'create']);
        Route::post('/admin/schedules/store', [AdminScheduleController::class, 'store']);
        Route::get('/admin/schedules/edit/{id}', [AdminScheduleController::class, 'edit']);
        Route::post('/admin/schedules/update/{id}', [AdminScheduleController::class, 'update']);
        Route::get('/admin/schedules/delete/{id}', [AdminScheduleController::class, 'destroy']);

        Route::get('/admin/bookings', [AdminBookingController::class, 'index']);
        Route::post('/admin/bookings/confirm/{id}', [AdminBookingController::class, 'confirm']);
        Route::post('/admin/bookings/verify-payment/{id}', [AdminBookingController::class, 'verifyPayment']);
        Route::post('/admin/bookings/reject-payment/{id}', [AdminBookingController::class, 'rejectPayment']);

        Route::get('/admin/report', [AdminController::class, 'report'])->name('admin.report');
        Route::get('/admin/report/pdf', [AdminController::class, 'generatePDF'])->name('admin.report.pdf');
    });
});