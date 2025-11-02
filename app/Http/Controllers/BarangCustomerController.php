<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\NegaraAsal;

class BarangCustomerController extends Controller
{
    public function create()
    {
        $negaraAsal = NegaraAsal::all();
        return view('customer.barang_customer.create', compact('negaraAsal'));
    }

   public function store(Request $request)
{
    $request->validate([
        'nama_barang'     => 'required|string|max:255',
        'jumlah_barang'   => 'required|integer|min:1',
        'id_negara_asal'  => 'required|integer',
    ]);

    Barang::create([
        'kode_barang'     => 'BRG-' . str_pad(Barang::max('id') + 1, 4, '0', STR_PAD_LEFT),
        'user_id'         => auth('customer')->id(),
        'nama_barang'     => $request->nama_barang,
        'jumlah_barang'   => $request->jumlah_barang,
        'id_negara_asal'  => $request->id_negara_asal,
        'nilai_cukai'     => null, // biarkan kosong, admin yang isi nanti
        'status'          => 'Pending',
    ]);

    return redirect()->route('customer.dashboard')
        ->with('success', 'Barang berhasil ditambahkan!');
}
}
