<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\NegaraAsalController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CustomerAuthController;

// ==================== HOME ====================
Route::get('/', function () {
    return view('home');
});

// ==================== ADMIN SECTION ====================

// Halaman Login Admin
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

// Logout Admin
Route::post('/admin/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/admin/login')->with('success', 'Logout berhasil.');
})->name('admin.logout');

// Grup Rute Admin dengan Prefix 'admin' dan Middleware
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // Barang Routes
    Route::resource('barang', BarangController::class);
    Route::post('/barang/{id}/mark-as-completed', [BarangController::class, 'markAsCompleted'])->name('barang.markAsCompleted');
    Route::post('/barang/{id}/mark-as-pending', [BarangController::class, 'markAsPending'])->name('barang.markAsPending');

    // NegaraAsal Routes
    Route::resource('negara', NegaraAsalController::class);
});

// ==================== CUSTOMER SECTION ====================
Route::prefix('customer')->group(function () {

    // 🔹 REGISTER CUSTOMER
    Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])
        ->name('customer.register.form');
    Route::post('/register', [CustomerAuthController::class, 'register'])
        ->name('customer.register.submit'); // diganti supaya sesuai Blade

    // 🔹 LOGIN CUSTOMER
    Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])
        ->name('customer.login.form');
    Route::post('/login', [CustomerAuthController::class, 'login'])
        ->name('customer.login.submit'); // diganti supaya sesuai Blade

    // 🔹 DASHBOARD CUSTOMER & LOGOUT
    Route::middleware('auth:customer')->group(function () {
        Route::get('/dashboard', [CustomerAuthController::class, 'dashboard'])
            ->name('customer.dashboard');
        Route::post('/logout', [CustomerAuthController::class, 'logout'])
            ->name('customer.logout');
    });
});
