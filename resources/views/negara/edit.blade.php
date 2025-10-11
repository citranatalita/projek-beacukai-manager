@extends('layouts.app')

@section('title', 'Edit Negara')
@section('page-title', 'Edit Negara')
@section('breadcrumb', 'Edit Negara')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Edit Negara</h5>
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

        <form action="{{ route('negara.update', $negaraAsal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_negara" class="form-label">Nama Negara</label>
                <input type="text" class="form-control" id="nama_negara" name="nama_negara" value="{{ old('nama_negara', $negaraAsal->nama_negara) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('negara.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
