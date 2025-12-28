<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\NegaraAsal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    // LIST BARANG (ADMIN / CUSTOMER)
    public function index(Request $request)
    {
        $query = Barang::with('negaraAsal', 'user');

        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'LIKE', "%$search%")
                  ->orWhere('kode_barang', 'LIKE', "%$search%")
                  ->orWhere('status', 'LIKE', "%$search%")
                  ->orWhereHas('negaraAsal', function ($n) use ($search) {
                      $n->where('nama_negara', 'LIKE', "%$search%");
                  });
            });
        }

        $barangs = $query->get();
        $negaraAsal = NegaraAsal::select('id', 'nama_negara', 'simbol')->get();

        return view('barang.index', compact('barangs', 'negaraAsal'));
    }

    // FORM INPUT BARANG
    public function create()
    {
        $negaraAsal = NegaraAsal::select('id', 'nama_negara', 'simbol')->get();
        return view('barang.create', compact('negaraAsal'));
    }

    // SIMPAN BARANG
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'    => 'required|string|max:255',
            'id_negara_asal' => 'required|exists:negara_asal,id',
            'jumlah_barang'  => 'required|integer|min:1',
            'nilai_cukai'    => 'nullable|numeric|min:0',
        ]);

        // Generate kode barang
        $lastBarang = Barang::orderBy('id', 'desc')->first();
        $nextNumber = $lastBarang ? intval(substr($lastBarang->kode_barang, 4)) + 1 : 1;
        $kodeBarang = 'BRG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Barang::create([
            'kode_barang'    => $kodeBarang,
            'nama_barang'    => $request->nama_barang,
            'id_negara_asal' => $request->id_negara_asal,
            'jumlah_barang'  => $request->jumlah_barang,
            'nilai_cukai'    => $request->nilai_cukai,
            'status'         => 'Pending',
            'is_completed'   => false,
            'user_id'        => Auth::id(),
        ]);

        // 🔔 NOTIFIKASI SESUAI ROLE
        if (Auth::user()->role === 'customer') {
            return redirect()->route('customer.dashboard')
                ->with('customer_notif', 'Barang berhasil ditambahkan dan sedang menunggu proses admin.');
        }

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    // FORM EDIT BARANG
    public function edit($id)
    {
        $barang = Barang::with('negaraAsal')->findOrFail($id);
        $negaraAsal = NegaraAsal::select('id', 'nama_negara', 'simbol')->get();

        return view('barang.edit', compact('barang', 'negaraAsal'));
    }

    // UPDATE BARANG
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang'    => 'required|string',
            'id_negara_asal' => 'required|exists:negara_asal,id',
            'jumlah_barang'  => 'required|integer|min:1',
            'nilai_cukai'    => 'required|numeric|min:0',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang'    => $request->nama_barang,
            'id_negara_asal' => $request->id_negara_asal,
            'jumlah_barang'  => $request->jumlah_barang,
            'nilai_cukai'    => $request->nilai_cukai,
            'status'         => $barang->status ?? 'Pending',
        ]);

        if (Auth::user()->role === 'admin') {
            return redirect()->route('barang.index')
                ->with('admin_notif', 'Barang ' . $barang->kode_barang . ' berhasil diperbarui.');
        }

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    // HAPUS BARANG
    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }

    // STATUS COMPLETED
    public function markAsCompleted($id)
    {
        Barang::findOrFail($id)->update([
            'is_completed' => true,
            'status' => 'Completed'
        ]);

        return redirect()->back()
            ->with('success', 'Barang berhasil ditandai Completed.');
    }

    // STATUS PENDING
    public function markAsPending($id)
    {
        Barang::findOrFail($id)->update([
            'is_completed' => false,
            'status' => 'Pending'
        ]);

        return redirect()->back()
            ->with('success', 'Barang berhasil ditandai Pending.');
    }
}
