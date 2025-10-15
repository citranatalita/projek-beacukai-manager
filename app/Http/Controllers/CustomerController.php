<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\NegaraAsal;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // Dashboard customer
    public function dashboard()
{
    $negaraAsal = \App\Models\NegaraAsal::all();

    // Ambil user ID dari guard customer
    $userId = auth('customer')->id();

    // Ambil semua barang milik customer yang sedang login
    $barangCustomer = \App\Models\Barang::where('user_id', $userId)
        ->latest()
        ->get();

    return view('customer.dashboard', compact('negaraAsal', 'barangCustomer'));
}


    // Simpan barang baru dari customer
    public function store(Request $request)
{
    $request->validate([
        'nama_barang' => 'required|string',
        'id_negara_asal' => 'required|exists:negara_asal,id',
        'jumlah_barang' => 'required|integer',
    ]);

    // Ambil user ID dari guard customer, bukan admin
    $userId = auth('customer')->id(); // pastikan customer login pakai guard 'web'

    // Buat kode barang otomatis
    $lastBarang = \App\Models\Barang::orderBy('id', 'desc')->first();
    $nextNumber = $lastBarang ? intval(substr($lastBarang->kode_barang, 4)) + 1 : 1;
    $kode = 'BRG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

    // Simpan barang baru
    \App\Models\Barang::create([
        'kode_barang' => $kode,
        'nama_barang' => $request->nama_barang,
        'id_negara_asal' => $request->id_negara_asal,
        'jumlah_barang' => $request->jumlah_barang,
        'nilai_cukai' => 0,
        'is_completed' => false,
        'user_id' => $userId, // dari login customer
    ]);

    return redirect()->route('customer.dashboard')->with('success', 'Barang berhasil ditambahkan.');
}


    // Logout customer
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('customer.login.form');
    }
}
