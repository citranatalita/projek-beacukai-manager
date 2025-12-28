<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\NegaraAsal;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total barang
        $totalBarang = Barang::count();

        // Barang per status
        $barangPerStatus = Barang::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Barang per negara
        $barangPerNegara = Barang::join('negara_asal', 'barangs.id_negara_asal', '=', 'negara_asal.id')
            ->select('negara_asal.nama_negara', DB::raw('count(*) as total'))
            ->groupBy('negara_asal.nama_negara')
            ->get();

        // Trend 7 hari terakhir
        $trend = Barang::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        return view('admin.dashboard', compact(
            'totalBarang',
            'barangPerStatus',
            'barangPerNegara',
            'trend'
        ));
    }
}