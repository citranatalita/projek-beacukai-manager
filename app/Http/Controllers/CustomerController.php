<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\NegaraAsal;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // ===============================
    // DASHBOARD CUSTOMER
    // ===============================
    public function dashboard()
    {
        $negaraAsal = NegaraAsal::all();
        $userId = auth('customer')->id();

        // Ambil barang milik customer
        $barangs = Barang::with('negaraAsal')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.dashboard', compact('negaraAsal', 'barangs'));
    }

    // ===============================
    // BARANG - CREATE
    // ===============================
    public function create()
    {
        $negaraAsal = NegaraAsal::all();
        return view('customer.barang_customer.create', compact('negaraAsal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'    => 'required|string|max:255',
            'id_negara_asal' => 'required|exists:negara_asal,id',
            'jumlah_barang'  => 'required|integer|min:1',
        ]);

        $userId = auth('customer')->id();

        // Generate kode barang otomatis
        $lastBarang = Barang::orderBy('id', 'desc')->first();
        $nextNumber = $lastBarang ? intval(substr($lastBarang->kode_barang, 4)) + 1 : 1;
        $kode = 'BRG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Barang::create([
            'kode_barang'    => $kode,
            'nama_barang'    => $request->nama_barang,
            'id_negara_asal' => $request->id_negara_asal,
            'jumlah_barang'  => $request->jumlah_barang,
            'nilai_cukai'    => 0,
            'is_completed'   => false,
            'user_id'        => $userId,
            'status'         => 'Pending',
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Barang berhasil ditambahkan.');
    }

    // ===============================
    // PROFIL CUSTOMER
    // ===============================
    public function profile()
    {
        $user = auth('customer')->user();
        return view('customer.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = auth('customer')->user();
        return view('customer.profile_edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth('customer')->user();

        $user->name = $request->name;
        $user->phone = $request->phone;

        // Upload foto jika ada
        if ($request->hasFile('photo')) {
            $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('uploads/profile'), $filename);
            $user->photo = $filename;
        }

        $user->save();

        return redirect()->route('customer.profile')->with('success', 'Profil berhasil diperbarui');
    }

    // ===============================
    // CETAK DOKUMEN BARANG CUSTOMER
    // ===============================
    public function printBarang($id)
    {
        $barang = Barang::with('negaraAsal')->findOrFail($id);
        $user = auth('customer')->user(); // ambil user yang login

        return view('customer.print.barang_print', compact('barang', 'user'));
    }

    // ===============================
    // LOGOUT CUSTOMER
    // ===============================
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.login.form');
    }
}