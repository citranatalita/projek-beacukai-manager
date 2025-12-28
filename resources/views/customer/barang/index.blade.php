@extends('layouts.customer')

@section('content')
<div class="container">
    <h2>Daftar Barang Saya</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Nilai Cukai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangs as $barang)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $barang->kode_barang }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->jumlah }}</td>
                <td>Rp {{ number_format($barang->nilai_cukai,0,',','.') }}</td>
                <td>{{ $barang->status }}</td>
                <td>
                    <a href="{{ route('customer.barang.print', $barang->id) }}" target="_blank" class="btn btn-sm btn-primary">
                        🖨 Cetak Struk
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada barang.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection