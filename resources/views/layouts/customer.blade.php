<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Customer</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #fdfafa;
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            width: 230px;
            height: 100vh;
            background-color: #af6161;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding: 30px 20px;
        }

        .sidebar h4 {
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
        }

        .sidebar a {
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            margin-bottom: 20px;
            transition: 0.2s;
            font-size: 15px;
        }

        .sidebar a:hover {
            color: #ffecec;
            transform: translateX(4px);
        }

        .content {
            margin-left: 250px;
            padding: 40px;
        }

        .btn-logout {
            background-color: #fff;
            color: #af6161;
            border: none;
            font-weight: 600;
        }

        .btn-logout:hover {
            background-color: #ffe1e1;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4>CUSTOMER</h4>

        <a href="{{ route('customer.dashboard') }}">📦 Barang Saya</a>

        <form action="{{ route('customer.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-logout w-100 mt-3">🚪 Logout</button>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>
