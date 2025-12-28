<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Customer</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: transparent;
        }

        /* 🌸 BACKGROUND ANIMASI */
        .sakura {
        position: absolute;
        top: -20px;
        width: 16px;
        height: 16px;
        background: #ff8fa3;
        transform: rotate(45deg);
        opacity: 0.8;
        animation: fall linear infinite;
    }

    .sakura::before,
    .sakura::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        background: #ff8fa3;
        border-radius: 50%;
    }

    .sakura::before {
        top: -8px;
        left: 0;
    }

    .sakura::after {
        left: -8px;
        top: 0;
    }

        @keyframes fall {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            100% {
                transform: translateY(110vh) translateX(40px);
                opacity: 0;
            }
        }

        /* SIDEBAR */
        .sidebar {
            width: 230px;
            height: 100vh;
            background-color: #af6161;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding: 30px 20px;
            z-index: 2;
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

        /* CONTENT */
        .content {
            margin-left: 250px;
            padding: 40px;
            position: relative;
            z-index: 1;
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

    <!-- 🌸 BACKGROUND SAKURA -->
    <div class="sakura-bg">
        @for ($i = 1; $i <= 30; $i++)
            <span class="sakura"
                style="
                    left: {{ rand(0, 100) }}%;
                    animation-duration: {{ rand(12, 25) }}s;
                    animation-delay: {{ rand(0, 10) }}s;
                ">
            </span>
        @endfor
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>CUSTOMER</h4>

        <a href="{{ route('customer.dashboard') }}">📦 Barang Saya</a>
        <a href="{{ route('customer.profile') }}">👤 Profil</a>

        <form action="{{ route('customer.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-logout w-100 mt-3">🚪 Logout</button>
        </form>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>
