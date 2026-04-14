<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);
        return redirect('/');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/dashboard');
        }
        return back();
    }

    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            $schedules = Schedule::where('stock', '>', 0)->latest()->paginate(10);
            $allSchedules = Schedule::where('stock', '>', 0)->get(); // Untuk stats
            return view('admin.dashboard', compact('schedules', 'allSchedules'));
        }

        // Jika user, kirim data jadwal untuk dipesan
        $query = Schedule::where('stock', '>', 0);

        // Handle search parameters
        if (request('origin')) {
            $query->where('origin', 'like', '%' . request('origin') . '%');
        }
        if (request('destination')) {
            $query->where('destination', 'like', '%' . request('destination') . '%');
        }
        if (request('plane_name')) {
            $query->where('plane_name', 'like', '%' . request('plane_name') . '%');
        }

        $schedules = $query->paginate(10)->appends(request()->query());
        $allSchedules = Schedule::where('stock', '>', 0)->get(); // Untuk stats
        return view('user.dashboard', compact('schedules', 'allSchedules'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
