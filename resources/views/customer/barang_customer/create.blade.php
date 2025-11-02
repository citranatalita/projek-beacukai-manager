@extends('layouts.customer')

@section('content')
<div class="container">
    <h4 class="mb-4 fw-bold">➕ Tambah Barang</h4>

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <form action="{{ route('customer.barang_customer.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jumlah Barang</label>
                    <input type="number" name="jumlah_barang" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Negara Asal</label>
                    <select name="id_negara_asal" class="form-select" required>
                        <option value="">-- Pilih Negara --</option>
                        @foreach ($negaraAsal as $negara)
                            <option value="{{ $negara->id }}">{{ $negara->nama_negara }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">Simpan</button>
                    <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary px-4">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
