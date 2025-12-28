@extends('layouts.customer')

@section('content')
<div class="container-fluid px-4">

    {{-- 🔔 NOTIFIKASI CUSTOMER --}}
    @if(session('customer_notif'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            🧾 {{ session('customer_notif') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Notif success lama (jika masih dipakai) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <h3 class="fw-bold mt-3 mb-4 text-center">📦 Daftar Barang Saya</h3>

    <div class="text-end mb-3">
        <a href="{{ route('customer.barang_customer.create') }}" class="btn btn-primary">
            + Tambah Barang
        </a>
    </div>

    <div class="card shadow border-0 rounded-3">
        <div class="card-body table-responsive">

            @if(isset($barangs) && $barangs->count() > 0)

                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Negara Asal</th>
                            <th>Jumlah</th>
                            <th>Nilai Cukai</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($barangs as $index => $barang)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $barang->kode_barang }}</strong></td>
                            <td>{{ ucfirst($barang->nama_barang) }}</td>
                            <td>{{ $barang->negaraAsal->nama_negara ?? '-' }}</td>
                            <td>{{ $barang->jumlah_barang }}</td>

                            {{-- Nilai Cukai --}}
                            <td>
                                @if(empty($barang->nilai_cukai) || $barang->nilai_cukai == 0)
                                    <span class="badge bg-secondary">Unknown</span>
                                @else
                                    @if($barang->negaraAsal)
                                        {{ $barang->negaraAsal->simbol }}
                                        {{ number_format($barang->nilai_cukai, 0, ',', '.') }}
                                    @else
                                        Rp {{ number_format($barang->nilai_cukai, 0, ',', '.') }}
                                    @endif
                                @endif
                            </td>

                            {{-- Status --}}
                            <td>
                                @switch($barang->status)
                                    @case('Pending')
                                        <span class="status-badge pending">Pending</span>
                                        @break
                                    @case('Approved')
                                    @case('Completed')
                                        <span class="status-badge completed">{{ $barang->status }}</span>
                                        @break
                                    @case('Rejected')
                                        <span class="status-badge rejected">Rejected</span>
                                        @break
                                    @default
                                        <span class="status-badge pending">Pending</span>
                                @endswitch
                            </td>

                            <td>{{ $barang->created_at->format('d-m-Y H:i') }}</td>

                            {{-- Tombol Cetak Dokumen --}}
                            <td>
                                <a href="{{ route('customer.barang.print', $barang->id) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-primary">
                                    🖨 Cetak Dokumen
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            @else
                <div class="text-center text-muted py-4">
                    Belum ada barang yang kamu input.
                </div>
            @endif

        </div>
    </div>
</div>

{{-- STYLE TABEL CUSTOMER --}}
<style>
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 18px;
        overflow: hidden;
        font-size: 20px;
        margin-top: 10px;
    }

    .custom-table thead {
        background-color: #f7c7da;
        color: #4a4a4a;
    }

    .custom-table th, .custom-table td {
        padding: 12px;
        border: 1px solid #e3a6bd;
        text-align: center;
    }

    .custom-table tr:hover {
        background-color: #ffeaf2;
    }

    .status-badge {
        padding: 6px 12px;
        font-size: 12px;
        font-weight: bold;
        border-radius: 8px;
        color: white;
    }

    .pending {
        background-color: #f1b400;
    }

    .completed {
        background-color: #4CAF50;
    }

    .rejected {
        background-color: #e63946;
    }

    th, td {
        white-space: nowrap;
    }
</style>

@endsection
