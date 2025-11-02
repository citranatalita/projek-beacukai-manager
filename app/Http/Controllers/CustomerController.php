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
        $negaraAsal = NegaraAsal::all();

        $userId = auth('customer')->id();

        // Ambil data langsung dari tabel barang berdasarkan user_id
        $barangs = Barang::with('negaraAsal')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // kirim ke view
        return view('customer.dashboard', [
            'negaraAsal' => $negaraAsal,
            'barangs' => $barangs
        ]);
    }

    // Tampilkan form tambah barang
    public function create()
    {
        $negaraAsal = NegaraAsal::all(); // pastikan data negara tersedia
        return view('customer.barang_customer.create', compact('negaraAsal'));
    }

    // Simpan barang baru dari customer
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'    => 'required|string|max:255',
            'id_negara_asal' => 'required|exists:negara_asal,id',
            'jumlah_barang'  => 'required|integer|min:1',
        ]);

        // Ambil user ID dari guard customer
        $userId = auth('customer')->id();

        // Buat kode barang otomatis
        $lastBarang = Barang::orderBy('id', 'desc')->first();
        $nextNumber = $lastBarang ? intval(substr($lastBarang->kode_barang, 4)) + 1 : 1;
        $kode = 'BRG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Simpan barang baru
        Barang::create([
            'kode_barang'    => $kode,
            'nama_barang'    => $request->nama_barang,
            'id_negara_asal' => $request->id_negara_asal,
            'jumlah_barang'  => $request->jumlah_barang,
            'nilai_cukai'    => 0, // default 0
            'is_completed'   => false,
            'user_id'        => $userId,
            'status'         => 'Pending',
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
