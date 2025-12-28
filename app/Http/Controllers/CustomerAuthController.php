<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomerAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('customer.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false, // pastikan customer bukan admin
        ]);

        Auth::guard('customer')->login($user); // pakai guard customer
        return redirect()->route('customer.dashboard');
    }

    public function showLoginForm()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) { // pakai guard customer
            return redirect()->route('customer.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    public function logout()
    {
        Auth::guard('customer')->logout(); // pakai guard customer
        return redirect()->route('customer.login.form');
    }

    public function dashboard()
    {
        return view('customer.dashboard'); // pastikan ada file dashboard.blade.php
    }

    public function editProfile()
{
    $user = auth()->user(); // Ambil data customer login
    return view('customer.profile.edit', compact('user'));
}

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Update nama
        $user->name = $request->name;
        $user->phone = $request->phone;

        // Upload foto jika ada
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);

            $user->photo = $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
