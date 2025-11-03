    @extends('layouts.customer')

    @section('content')
    <div class="container-fluid px-4">
        <h3 class="fw-bold mt-3 mb-4 text-center">📦 Daftar Barang Saya</h3>

        <div class="text-end mb-3">
            <a href="{{ route('customer.barang_customer.create') }}" class="btn btn-primary">
                + Tambah Barang
            </a>
        </div>

        <div class="card shadow border-0 rounded-3">
            <div class="card-body table-responsive">
                @if(isset($barangs) && $barangs->count() > 0)
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Negara Asal</th>
                                <th>Jumlah</th>
                                <th>Nilai Cukai</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangs as $index => $barang)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $barang->kode_barang }}</strong></td>
                                    <td>{{ ucfirst($barang->nama_barang) }}</td>
                                    <td>{{ $barang->negaraAsal->nama_negara ?? '-' }}</td>
                                    <td>{{ $barang->jumlah_barang }}</td>

                                    {{-- nilai cukai --}}
                                    <td>
                                        @if(empty($barang->nilai_cukai) || $barang->nilai_cukai == 0)
                                            <span class="badge bg-secondary">Unknown</span>
                                        @else
                                            Rp {{ number_format($barang->nilai_cukai, 0, ',', '.') }}
                                        @endif
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        @switch($barang->status)
                                            @case('Pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                                @break
                                            @case('Approved')
                                            @case('Completed')
                                                <span class="badge bg-success">{{ $barang->status }}</span>
                                                @break
                                            @case('Rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">Pending</span>
                                        @endswitch
                                    </td>

                                    <td>{{ $barang->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center text-muted py-4">
                        Belum ada barang yang kamu input.
                    </div>
                @endif
            </div>
        </div>
    </div>


    <style>
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        th, td {
            white-space: nowrap;
        }
    </style>
    @endsection
