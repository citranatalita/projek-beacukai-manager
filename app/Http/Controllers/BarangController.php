<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\NegaraAsal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
     public function index()
    {
        
        if (Auth::user()->role === 'admin') {
            $barangs = Barang::with('negaraAsal')->get();
        } else {
            $barangs = Barang::with('negaraAsal')
                ->where('user_id', Auth::id())
                ->get();
        }

        return view('barang.index', compact('barangs'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'id_negara_asal' => 'required|exists:negara_asal,id',
            'jumlah_barang' => 'required|integer|min:1',
            'nilai_cukai' => 'required|numeric|min:0',
        ]);

        // Buat kode barang otomatis: BRG-0001, BRG-0002,
        $lastBarang = Barang::orderBy('id', 'desc')->first();
        $nextNumber = $lastBarang ? intval(substr($lastBarang->kode_barang, 4)) + 1 : 1;
        $kode = 'BRG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Simpan barang baru
        Barang::create([
            'kode_barang' => $kode,
            'nama_barang' => $request->nama_barang,
            'id_negara_asal' => $request->id_negara_asal,
            'jumlah_barang' => $request->jumlah_barang,
            'nilai_cukai' => $request->nilai_cukai,
            'is_completed' => false,
            'user_id' => Auth::id(), // user yang sedang login (customer / admin)
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barang = Barang::with('negaraAsal')->findOrFail($id);
        $negaraAsal = NegaraAsal::select('id', 'nama_negara', 'simbol')->get();
        return view('barang.edit', compact('barang', 'negaraAsal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'id_negara_asal' => 'required|exists:negara_asal,id',
            'jumlah_barang' => 'required|integer',
            'nilai_cukai' => 'required|string',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'id_negara_asal' => $request->id_negara_asal,
            'jumlah_barang' => $request->jumlah_barang,
            'nilai_cukai' => $request->nilai_cukai,
            'status' => $barang->status ?? 'Pending',
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }

    // barang sebagai Completed
        public function markAsCompleted($id)
{
    $barang = Barang::findOrFail($id);
    $barang->is_completed = true;
    $barang->status = 'Completed'; // tambahan penting
    $barang->save();

    return redirect()->back()->with('success', 'Barang berhasil ditandai sebagai Completed');
}

public function markAsPending($id)
{
    $barang = Barang::findOrFail($id);
    $barang->is_completed = false;
    $barang->status = 'Pending'; // tambahan penting
    $barang->save();

    return redirect()->back()->with('success', 'Barang berhasil ditandai sebagai Pending');
}





    public function create()
{
    $negaraAsal = NegaraAsal::select('id', 'nama_negara', 'simbol')->get();
    return view('barang.create', compact('negaraAsal'));
}


}
