@extends('layouts.app')

@section('title', 'Tambah Negara')
@section('page-title', 'Tambah Negara')
@section('breadcrumb', 'Tambah Negara')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Tambah Negara Baru</h5>
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
                <label for="nama_negara" class="form-label">Nama Negara</label>
                <input type="text" class="form-control" id="nama_negara" name="nama_negara" value="{{ old('nama_negara') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('negara.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
