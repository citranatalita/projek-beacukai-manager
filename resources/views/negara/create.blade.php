@extends('layouts.app')

@section('title', 'Tambah Negara')
@section('page-title', 'Tambah Negara')
@section('breadcrumb', 'Tambah Negara')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Negara Baru</h5>
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

        <form action="{{ route('negara.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Negara</label>
                <input type="text"
                       name="nama_negara"
                       class="form-control"
                       value="{{ old('nama_negara') }}">
            </div>

            <div class="mb-3">
                <label>Simbol</label>
                <input type="text"
                       name="simbol"
                       class="form-control"
                       value="{{ old('simbol') }}">
            </div>

            <div class="mb-3">
                <label>Kode Mata Uang</label>
                <input type="text"
                       name="kode_mata_uang"
                       class="form-control"
                       value="{{ old('kode_mata_uang') }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('negara.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</div>
@endsection