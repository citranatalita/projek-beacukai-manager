@extends('layouts.app')

@section('title', 'Daftar Barang')
@section('page-title', 'Daftar Barang')
@section('breadcrumb', 'Barang')

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Barang</h5>
        <a href="{{ route('barang.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Barang Baru
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="datatablesSimple">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Negara Asal</th>
                        <th>Status</th>
                        <th>Jumlah Barang</th>
                        <th>Harga Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($barangs as $barang)
                        <tr class="align-middle text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->negaraAsal->nama_negara ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $barang->is_completed ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $barang->is_completed ? 'Completed' : 'Pending' }}
                                </span>
                            </td>
                            <td>{{ $barang->jumlah_barang }}</td>

                            {{-- 💰 Tampilkan harga sesuai mata uang negara --}}
                            <td>
                                @php
                                    $simbol = $barang->negaraAsal->simbol ?? 'Rp';
                                @endphp
                                {{ $simbol }} {{ number_format($barang->harga_barang, 0, ',', '.') }}
                            </td>

                            {{-- 🔧 Tombol Aksi --}}
                            <td>
                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning btn-sm mb-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                @if ($barang->is_completed)
                                    <form action="{{ route('barang.markAsPending', $barang->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary btn-sm mb-1">
                                            <i class="fas fa-clock"></i> Pending
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('barang.markAsCompleted', $barang->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm mb-1">
                                            <i class="fas fa-check"></i> Completed
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
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
                            <td colspan="7" class="text-center text-muted">Tidak ada barang yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
