@extends('layouts.app')

@section('content')


<div class="container mt-4">
    <h2>Daftar Barang Bea Cukai</h2>
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Negara Asal</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
            <tr>
                <td>{{ $barang->kode_barang }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->negaraAsal->nama_negara ?? '-' }}</td>
                <td>{{ $barang->jumlah_barang }}</td>
                <td>{{ $barang->harga_barang }}</td>
                <td>
                    @if($barang->is_completed)
                        <span class="badge bg-success">Completed</span>
                    @else
                        <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
