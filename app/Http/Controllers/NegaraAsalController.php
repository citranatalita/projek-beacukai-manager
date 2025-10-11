<?php

namespace App\Http\Controllers;

use App\Models\NegaraAsal;
use Illuminate\Http\Request;

class NegaraAsalController extends Controller
{
    // Menampilkan daftar semua negara asal
    public function index()
    {
        $negaraAsals = NegaraAsal::all();
        return view('negara.index', compact('negaraAsals'));
    }

    // Menampilkan form untuk membuat negara asal baru
    public function create()
    {
        return view('negara.create');
    }

    // Menyimpan data negara asal baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_negara' => 'required|string|max:255',
            'simbol' => 'required|string|max:5',
            'kode_mata_uang' => 'required|string|max:5',
        ]);

        NegaraAsal::create([
            'nama_negara' => $request->nama_negara,
            'simbol' => $request->simbol,
            'kode_mata_uang' => $request->kode_mata_uang,
        ]);

        return redirect()->route('negara.index')->with('success', 'Negara asal berhasil ditambahkan.');
    }

    // Menampilkan detail negara asal tertentu
    public function show($id)
    {
        $negaraAsal = NegaraAsal::findOrFail($id);
        return view('negara.show', compact('negaraAsal'));
    }

    // Menampilkan form untuk mengedit data negara asal
    public function edit($id)
    {
        $negaraAsal = NegaraAsal::findOrFail($id);
        return view('negara.edit', compact('negaraAsal'));
    }

    // Memperbarui data negara asal
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_negara' => 'required|string|max:255',
            'simbol' => 'required|string|max:5',
            'kode_mata_uang' => 'required|string|max:5',
        ]);

        $negaraAsal = NegaraAsal::findOrFail($id);
        $negaraAsal->update([
            'nama_negara' => $request->nama_negara,
            'simbol' => $request->simbol,
            'kode_mata_uang' => $request->kode_mata_uang,
        ]);

        return redirect()->route('negara.index')->with('success', 'Negara asal berhasil diperbarui.');
    }

    // Menghapus data negara asal
    public function destroy($id)
    {
        $negaraAsal = NegaraAsal::findOrFail($id);
        $negaraAsal->delete();

        return redirect()->route('negara.index')->with('success', 'Negara asal berhasil dihapus.');
    }
}
