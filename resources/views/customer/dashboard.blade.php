<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #ceb595ff;
        }
        nav.navbar {
            background-color: #c4a885ff;
        }
        nav.navbar .navbar-brand, nav.navbar .nav-link {
            color: #fff !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard Customer</a>
            <div class="ms-auto">
                <form action="{{ route('customer.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container mt-5">
        <h3 class="mb-4 text-center">Tambah Barang Anda</h3>

        <!-- Pesan Error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Tambah Barang -->
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('customer.barang.store') }}" method="POST">
                    @csrf

                    {{-- Nama Barang --}}
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
                    </div>

                    {{-- Negara Asal --}}
                    <div class="mb-3">
                        <label for="id_negara_asal" class="form-label">Negara Asal</label>
                        <select name="id_negara_asal" id="id_negara_asal" class="form-select" required>
                            <option value="" disabled selected>Pilih Negara</option>
                            @foreach ($negaraAsal as $negara)
                                <option value="{{ $negara->id }}">{{ $negara->nama_negara }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jumlah Barang --}}
                    <div class="mb-3">
                        <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                        <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" value="{{ old('jumlah_barang') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Barang</button>
                </form>
            </div>
        </div>

        <!-- Daftar Barang Customer -->
        <div class="mt-5">
            <h4 class="mb-3">Barang Anda</h4>
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Negara Asal</th>
                        <th>Jumlah</th>
                        <th>Nilai Cukai</th>
                        <th>Status</th>
                        <th>Tanggal Ditambahkan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangCustomer as $barang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->negaraAsal->nama_negara ?? '-' }}</td>
                            <td>{{ $barang->jumlah_barang }}</td>
                            <td>
                                @if($barang->nilai_cukai == 0)
                                    <span class="text-muted">Belum ditentukan</span>
                                @else
                                    @php
                                        $simbol = $barang->negaraAsal->simbol ?? 'Rp';
                                    @endphp
                                    {{ $simbol }} {{ number_format($barang->nilai_cukai, 0, ',', '.') }}
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $barang->is_completed ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $barang->is_completed ? 'Completed' : 'Pending' }}
                                </span>
                            </td>
                            <td>{{ $barang->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</body>
</html>
