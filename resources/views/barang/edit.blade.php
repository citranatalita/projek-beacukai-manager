@extends('layouts.app')

@section('title', 'Edit Barang')
@section('page-title', 'Edit Barang')
@section('breadcrumb', 'Edit Barang')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Edit Barang</h5>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Barang --}}
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
            </div>

            {{-- Negara Asal --}}
            <div class="mb-3">
                <label for="id_negara_asal" class="form-label">Negara Asal</label>
                <select class="form-select" id="id_negara_asal" name="id_negara_asal" required>
                    @foreach ($negaraAsal as $negara)
                        <option 
                            value="{{ $negara->id }}" 
                            data-simbol="{{ $negara->simbol ?? 'Rp' }}"
                            {{ $barang->id_negara_asal == $negara->id ? 'selected' : '' }}
                        >
                            {{ $negara->nama_negara }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Jumlah Barang --}}
            <div class="mb-3">
                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" value="{{ old('jumlah_barang', $barang->jumlah_barang) }}" required>
            </div>

            {{-- Nilai Cukai --}}
            <div class="mb-3">
                <label for="nilai_cukai" class="form-label" id="label_nilai_cukai">Nilai Cukai (Rp)</label>
                <input 
                    type="number" 
                    class="form-control" 
                    id="nilai_cukai" 
                    name="nilai_cukai" 
                    value="{{ old('nilai_cukai', $barang->nilai_cukai) }}" 
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

{{-- Script ubah simbol otomatis --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectNegara = document.getElementById('id_negara_asal');
    const labelCukai = document.getElementById('label_nilai_cukai');

    selectNegara.addEventListener('change', function() {
        const simbol = this.options[this.selectedIndex].getAttribute('data-simbol') || 'Rp';
        labelCukai.textContent = `Nilai Cukai (${simbol})`;
    });
});
</script>
@endsection
