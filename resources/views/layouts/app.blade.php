<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Support Stand Dashboard" />
    <meta name="author" content="Support Stand" />
    <title>@yield('title', 'Dashboard') - Support Stand</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSS Vendor -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <!-- CSS Custom -->
    <link href="{{ asset('templates/css/styles.css') }}" rel="stylesheet" />
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    @include('layouts.navbar')

    <div id="layoutSidenav">
        @include('layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @hasSection('page-title')
                        <h1 class="mt-4">@yield('page-title')</h1>
                    @endif

                    @hasSection('breadcrumb')
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">@yield('breadcrumb')</li>
                        </ol>
                    @endif

                    @yield('content')
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">© 2025 Beacukai Manager 🚢</div>

                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('templates/vendor/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('templates/vendor/Chart.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('templates/vendor/simple-datatables.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('templates/js/scripts.js') }}"></script>
    <script src="{{ asset('templates/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('templates/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('templates/js/datatables-simple-demo.js') }}"></script>
</body>
</html>