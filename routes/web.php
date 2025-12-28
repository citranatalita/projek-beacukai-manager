<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\NegaraAsalController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::get('/', function () {
    return view('home');
});

// ====================
// ADMIN LOGIN
// ====================
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

Route::post('/admin/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/admin/login')->with('success', 'Logout berhasil.');
})->name('admin.logout');

// ====================
// ADMIN AREA
// ====================
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // BARANG ADMIN
    Route::resource('barang', BarangController::class);

    Route::post('/barang/{id}/completed', [BarangController::class, 'markAsCompleted'])
        ->name('barang.markAsCompleted');

    Route::post('/barang/{id}/pending', [BarangController::class, 'markAsPending'])
        ->name('barang.markAsPending');

    // NEGARA ASAL
    Route::resource('negara', NegaraAsalController::class);

    // PROFIL ADMIN
    Route::get('/profile', [AdminProfileController::class, 'profile'])
        ->name('admin.profile');

    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])
        ->name('admin.profile.edit');

    Route::post('/profile/update', [AdminProfileController::class, 'update'])
        ->name('admin.profile.update');
});

// ====================
// CUSTOMER SECTION
// ====================
Route::prefix('customer')->group(function () {

    // REGISTER
    Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register.form');
    Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');

    // LOGIN
    Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login.form');
    Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');

    // ========================
    // CUSTOMER AUTH
    // ========================
    Route::middleware(['auth:customer'])->group(function () {

        Route::get('/dashboard', [CustomerController::class, 'dashboard'])
            ->name('customer.dashboard');

        // CUSTOMER TAMBAH BARANG
        Route::get('/barang_customer/create', [CustomerController::class, 'create'])
            ->name('customer.barang_customer.create');

        Route::post('/barang_customer', [CustomerController::class, 'store'])
            ->name('customer.barang_customer.store');

        // CETAK BARANG CUSTOMER
        Route::get('/barang/{id}/print', [CustomerController::class, 'printBarang'])
            ->name('customer.barang.print');

        // PROFILE CUSTOMER
        Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
        Route::get('/profile/edit', [CustomerController::class, 'editProfile'])->name('customer.profile.edit');
        Route::post('/profile/update', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');

        // LOGOUT
        Route::post('/logout', [CustomerController::class, 'logout'])
            ->name('customer.logout');
    });
});