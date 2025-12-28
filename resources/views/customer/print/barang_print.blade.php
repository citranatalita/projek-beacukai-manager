<!DOCTYPE html>
<html>
<head>
    <title>Dokumen Barang Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin: 0;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            text-align: center;
        }

        td {
            vertical-align: middle;
        }

        td.text-center {
            text-align: center;
        }

        td.text-right {
            text-align: right;
        }
    </style>
</head>
<body>

<h2>Dokumen Barang Customer</h2>
<p>Customer: <strong>{{ $user->name }}</strong></p>
<p>Dicetak pada: {{ now()->format('d-m-Y H:i') }}</p>

<table>
    <thead>
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Negara Asal</th>
            <th>Jumlah</th>
            <th>Nilai Cukai</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center">{{ $barang->kode_barang }}</td>
            <td>{{ $barang->nama_barang }}</td>
            <td>{{ $barang->negaraAsal->nama_negara ?? '-' }}</td>
            <td class="text-center">{{ $barang->jumlah_barang }}</td>
            <td class="text-right">
                @if(empty($barang->nilai_cukai) || $barang->nilai_cukai == 0)
                    Unknown
                @else
                    {{ $barang->negaraAsal->simbol ?? 'Rp' }} {{ number_format($barang->nilai_cukai, 0, ',', '.') }}
                @endif
            </td>
            <td class="text-center">{{ $barang->status }}</td>
        </tr>
    </tbody>
</table>

<script>
    window.print();
</script>

</body>
</html>