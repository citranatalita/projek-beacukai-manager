<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\NegaraAsalController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;

// ====================
// HOME
// ====================
Route::get('/', function () {
    return view('home');
});

// ====================
// ADMIN SECTION
// ====================

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

    // Update status barang (Completed / Pending)
    Route::post('/barang/{id}/completed', [BarangController::class, 'markAsCompleted'])->name('barang.markAsCompleted');
    Route::post('/barang/{id}/pending', [BarangController::class, 'markAsPending'])->name('barang.markAsPending');

    // Negara Asal Routes
    Route::resource('negara', NegaraAsalController::class);
});


// ====================
// CUSTOMER SECTION
// ====================

// Autentikasi Customer
Route::prefix('customer')->group(function () {

    // REGISTER
    Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register.form');
    Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');

    // LOGIN
    Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login.form');
    Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');

    // ==========================
    // Dashboard & Barang Customer
    // ==========================
    Route::middleware(['auth:customer'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');

        // Form tambah barang
        Route::get('/barang_customer/create', [CustomerController::class, 'create'])
        ->name('customer.barang_customer.create');


        // Simpan barang
        Route::post('/barang_customer', [CustomerController::class, 'store'])
        ->name('customer.barang_customer.store');
        // Logout
        Route::post('/logout', [CustomerController::class, 'logout'])->name('customer.logout');
    });
});



