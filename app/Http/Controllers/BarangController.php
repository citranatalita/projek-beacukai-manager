<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\NegaraAsal;
use Illuminate\Http\Request;


class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('negaraAsal')->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        $negaraAsal = NegaraAsal::all();
        return view('barang.create', compact('negaraAsal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'id_negara_asal' => 'required|exists:negara_asal,id',
            'jumlah_barang' => 'required|integer',
            'harga_barang' => 'required|string',
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'id_negara_asal' => $request->id_negara_asal,
            'jumlah_barang' => $request->jumlah_barang,
            'harga_barang' => $request->harga_barang,
            'is_completed' => false, // Default pending
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
{
    $barang = Barang::with('negaraAsal')->findOrFail($id);
    $negaraAsal = \App\Models\NegaraAsal::select('id', 'nama_negara', 'simbol')->get();

    return view('barang.edit', compact('barang', 'negaraAsal'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'id_negara_asal' => 'required|exists:negara_asal,id',
            'jumlah_barang' => 'required|integer',
            'harga_barang' => 'required|string',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'id_negara_asal' => $request->id_negara_asal,
            'jumlah_barang' => $request->jumlah_barang,
            'harga_barang' => $request->harga_barang,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }

    public function markAsCompleted($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->is_completed = true;
        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang ditandai sebagai Completed.');
    }

    public function markAsPending($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->is_completed = false;
        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang ditandai sebagai Pending.');
    }
}
