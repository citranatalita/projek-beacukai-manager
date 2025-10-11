<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = User::where('email', $request->email)->where('is_admin', true)->first();

        if (!$admin) {
            return redirect()->back()->with('error', 'Email tidak ditemukan atau bukan admin.');
        }

        // Verifikasi password
        if (Hash::check($request->password, $admin->password)) {
            Auth::login($admin);

            // Redirect ke halaman barang setelah login
            return redirect()->route('barang.index'); // Arahkan ke halaman barang
        }

        return redirect()->back()->with('error', 'Password salah.');
    }

    // Proses logout admin
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }
}
