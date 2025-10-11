@extends('layouts.app')

@section('title', 'Daftar Negara')
@section('page-title', 'Daftar Negara')
@section('breadcrumb', 'Negara')

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">List of Negara</h5>
        <a href="{{ route('negara.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Negara Baru
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="datatablesSimple">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Negara</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($negaraAsals as $negaraItem)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $negaraItem->nama_negara }}</td>
                            <td>
                                <a href="{{ route('negara.edit', $negaraItem->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('negara.destroy', $negaraItem->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus negara ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada negara.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
