@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-3">Daftar Barang Bea Cukai</h2>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Negara Asal</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Cetak</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($barangs as $barang)
                <tr>
                    <td>{{ $barang->kode_barang }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->negaraAsal->nama_negara ?? '-' }}</td>
                    <td>{{ $barang->jumlah_barang }}</td>
                    <td>{{ number_format($barang->harga_barang, 0, ',', '.') }}</td>

                    <td>
                        @if($barang->is_completed)
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </td>

                    <td>
                        @if($barang->is_completed)
                            <a href="{{ route('customer.barang.cetak', $barang->id) }}"
                               class="btn btn-primary btn-sm"
                               target="_blank">
                               Cetak PDF
                            </a>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>
                                Belum Selesai
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada barang terdaftar</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection