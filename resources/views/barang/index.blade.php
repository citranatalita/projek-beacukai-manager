@extends('layouts.app')

@section('title', 'Daftar Barang')
@section('page-title', 'Daftar Barang')


@section('content')
<div class="container-fluid px-4">


    

    <div class="card admin-card">
        <div class="card-body">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
         
                <a href="{{ route('barang.create') }}" class="btn btn-dark rounded-pill px-4">
                    ➕ Tambah Barang
                </a>
            </div>

            {{-- NOTIF --}}
            @if(session('admin_notif'))
                <div class="alert alert-info alert-dismissible fade show">
                    {{ session('admin_notif') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Negara Asal</th>
                            <th>Status</th>
                            <th>Jumlah</th>
                            <th>Nilai Cukai</th>
                            <th>Penginput</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangs as $barang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $barang->kode_barang }}</strong></td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->negaraAsal->nama_negara ?? '-' }}</td>

                            <td>
                                @if($barang->is_completed)
                                    <span class="badge-status completed">✅ Completed</span>
                                @else
                                    <span class="badge-status pending">⏳ Pending</span>
                                @endif
                            </td>

                            <td>{{ $barang->jumlah_barang }}</td>
                            <td>
                                {{ $barang->negaraAsal->simbol ?? 'Rp' }}
                                {{ number_format($barang->nilai_cukai,0,',','.') }}
                            </td>
                            <td>{{ $barang->user->name ?? '-' }}</td>
                            <td>{{ $barang->created_at->format('d-m-Y H:i') }}</td>

                            <td class="aksi">
                                <a href="{{ route('barang.edit',$barang->id) }}" class="btn btn-edit">✏ Edit</a>

                                @if(!$barang->is_completed)
                                    <form action="{{ route('barang.markAsCompleted',$barang->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-done">✔ Completed</button>
                                    </form>
                                @else
                                    <form action="{{ route('barang.markAsPending',$barang->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-pending">⏱ Pending</button>
                                    </form>
                                @endif

                                <form action="{{ route('barang.destroy',$barang->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-delete">🗑 Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- STYLE SOFT PINK --}}
<style>
.admin-card{
    border-radius:20px;
    border:none;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.admin-table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}

.admin-table thead{
    background:#fbcfe8;
    color:#6b213e;
}

.admin-table th{
    padding:14px;
    font-weight:500;
}

.admin-table td{
    padding:14px;
    border-bottom:1px solid #f3d5df;
}

.admin-table tbody tr:nth-child(even){
    background:#fff5f7;
}

.admin-table tbody tr:hover{
    background:#fdecef;
}

.badge-status{
    padding:6px 14px;
    border-radius:999px;
    font-size:12px;
    font-weight:500;
}

.completed{
    background:#dcfce7;
    color:#166534;
}

.pending{
    background:#fef3c7;
    color:#92400e;
}

.aksi{
    display:flex;
    gap:6px;
    flex-wrap:wrap;
    justify-content:center;
}

.btn{
    border-radius:999px;
    font-size:12px;
    padding:6px 12px;
    border:none;
}

.btn-edit{background:#fde68a;}
.btn-done{background:#86efac;}
.btn-pending{background:#fcd34d;}
.btn-delete{background:#fecaca;}
</style>
@endsection
