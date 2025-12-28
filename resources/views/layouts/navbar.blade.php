<nav class="sb-topnav navbar navbar-expand navbar-dark shadow-sm" style="background-color: #2c2c2c;">
    <!-- Logo / Brand -->
    <a class="navbar-brand ps-3 fw-bold" href="{{ route('barang.index') }}">
        <i class="fas fa-cog me-2"></i> Admin
    </a>

    <!-- Sidebar Toggle -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 ms-2" id="sidebarToggle">
        <i class="fas fa-bars fs-5"></i>
    </button>

    <!-- User Dropdown -->
    <ul class="navbar-nav ms-auto me-3">
        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown" href="#" data-bs-toggle="dropdown">
                

                <span class="fw-semibold">{{ Auth::user()->name }}</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow">

                <!-- Profil -->
                <li>
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                        <i class="fas fa-user-cog me-2"></i> Profil Admin
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <!-- Logout -->
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger" type="submit">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>