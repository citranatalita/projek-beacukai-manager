<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- 🤍 BACKGROUND LOVE GOLD -->
    <style>
    body {
        background: #c4d5e6ff; /* abu muda */
        position: relative;
        overflow-x: hidden;
    }

    .love-bg {
        position: fixed;
        inset: 0;
        z-index: -10;
        overflow: hidden;
    }

    .love {
        position: absolute;
        width: 42px;
        height: 42px;

        /* GOLD GRADIENT */
        background: linear-gradient(
            135deg,
            #000000ff,
            #000000ff,
            rgba(0, 0, 0, 1)
        );

        transform: rotate(45deg);
        animation: floatLove linear infinite;

        /* GLOW EMAS */
        box-shadow:
            0 0 10px rgba(255, 215, 0, 0.6),
            0 0 25px rgba(255, 183, 0, 0.35);
    }

    .love::before,
    .love::after {
        content: '';
        position: absolute;
        width: 42px;
        height: 42px;
        background: inherit;
        border-radius: 50%;
    }

    .love::before {
        top: -21px;
        left: 0;
    }

    .love::after {
        left: -21px;
        top: 0;
    }

    @keyframes floatLove {
        0% {
            transform: translateY(110vh) rotate(45deg);
            opacity: 0;
        }
        25% {
            opacity: 0.9;
        }
        100% {
            transform: translateY(-130vh) rotate(45deg);
            opacity: 0;
        }
    }
</style>

</head>

<body class="text-gray-800">

    <!-- LOVE BACKGROUND -->
    <div class="love-bg">
        <div class="love" style="left:10%; animation-duration:28s;"></div>
        <div class="love" style="left:25%; animation-duration:32s;"></div>
        <div class="love" style="left:45%; animation-duration:26s;"></div>
        <div class="love" style="left:60%; animation-duration:34s;"></div>
        <div class="love" style="left:75%; animation-duration:30s;"></div>
    </div>

    <div class="flex min-h-screen relative z-10">

        {{-- SIDEBAR --}}
        @include('admin.partials.sidebar')

        <div class="flex-1">

            {{-- NAVBAR --}}
            @include('admin.partials.navbar')

            {{-- CONTENT --}}
            <main class="p-6">
                @yield('content')
            </main>

        </div>
    </div>

    @yield('scripts')

</body>
</html>
    