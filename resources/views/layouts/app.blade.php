<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ZIS Masjid Al Madani') }}</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background-color: #212529;
            color: #fff;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, .75);
            font-weight: 500;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, .1);
            border-radius: .25rem;
        }
        .navbar-brand {
            font-weight: 700;
        }
        .main-content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4 mt-2">
                        <h5 class="text-white">ZIS Al Madani</h5>
                    </div>
                    <ul class="nav flex-column px-2">
                        <!-- Common Menu (All Roles) -->
                        <hr class="sidebar-divider">
                        <div class="sidebar-heading">Fitur Umum</div>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('profil.*') ? 'active' : '' }}" href="{{ route('profil.index') }}">
                                <i class="bi bi-person-badge"></i>
                                <span>Profil Pengguna</span>
                            </a>
                        </li>

                        @if(auth()->user()->role == 'admin_panitia')
                            <!-- Admin Panitia Menu -->
                            <hr class="sidebar-divider">
                            <div class="sidebar-heading">Menu Utama Admin</div>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            
                            <hr class="sidebar-divider">
                            <div class="sidebar-heading">Master Data Admin</div>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.muzakki.*') ? 'active' : '' }}" href="{{ route('admin.muzakki.index') }}">
                                    <i class="bi bi-people"></i>
                                    <span>Data Muzakki</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}" href="{{ route('admin.transaksi.index') }}">
                                    <i class="bi bi-cash-stack"></i>
                                    <span>Transaksi Zakat</span>
                                </a>
                            </li>

                            <!-- Admin Panitia Laporan -->
                            <hr class="sidebar-divider">
                            <div class="sidebar-heading">Laporan & Cetak</div>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.laporan.transaksi*') ? 'active' : '' }}" href="{{ route('admin.laporan.transaksi') }}">
                                    <i class="bi bi-file-earmark-bar-graph"></i>
                                    <span>Laporan Transaksi</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.laporan.distribusi*') ? 'active' : '' }}" href="{{ route('admin.laporan.distribusi') }}">
                                    <i class="bi bi-file-earmark-check"></i>
                                    <span>Laporan Distribusi</span>
                                </a>
                            </li>

                            <!-- Admin Panitia Pengaturan -->
                            <hr class="sidebar-divider">
                            <div class="sidebar-heading">Sistem & Akses</div>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                    <i class="bi bi-person-lines-fill"></i>
                                    <span>Manajemen Pengguna</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                                    <i class="bi bi-gear-fill"></i>
                                    <span>Pengaturan Zakat</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->role == 'amil')
                            <!-- Amil Menu -->
                            <hr class="sidebar-divider">
                            <div class="sidebar-heading">Menu Utama Amil</div>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('amil.dashboard') ? 'active' : '' }}" href="{{ route('amil.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <hr class="sidebar-divider">
                            <div class="sidebar-heading">Master Data Amil</div>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('amil.mustahik.*') ? 'active' : '' }}" href="{{ route('amil.mustahik.index') }}">
                                    <i class="bi bi-person-hearts"></i>
                                    <span>Data Mustahik</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('amil.distribusi.*') ? 'active' : '' }}" href="{{ route('amil.distribusi.index') }}">
                                    <i class="bi bi-box-seam"></i>
                                    <span>Distribusi Zakat</span>
                                </a>
                            </li>

                            <!-- Amil Laporan -->
                            <hr class="sidebar-divider">
                            <div class="sidebar-heading">Laporan & Cetak</div>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('amil.laporan.distribusi*') ? 'active' : '' }}" href="{{ route('amil.laporan.distribusi') }}">
                                    <i class="bi bi-file-earmark-check"></i>
                                    <span>Laporan Distribusi</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 shadow-sm rounded-3 mt-3">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1">@yield('header')</span>
                        
                        <div class="d-flex align-items-center">
                            <span class="me-3 text-secondary">
                                Welcome, <strong>{{ Auth::user()->name }}</strong> 
                                <span class="badge bg-primary ms-1">{{ Auth::user()->role }}</span>
                            </span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                            </form>
                        </div>
                    </div>
                </nav>

                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>
