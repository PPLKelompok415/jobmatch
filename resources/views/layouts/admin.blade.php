<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - JobMatch</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 56px;
            background-color: #f8f9fa;
        }
        .sidebar {
            position: fixed;
            top: 56px;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background-color: #343a40;
        }
        .sidebar-sticky {
            position: sticky;
            top: 0;
            height: calc(100vh - 56px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #ddd;
            padding: 0.75rem 1rem;
            border-left: 4px solid transparent;
            text-decoration: none;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #007bff;
        }
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #007bff;
        }
        .navbar-brand {
            font-size: 1.1rem;
            background-color: #343a40;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }
        main {
            padding-top: 1.5rem;
        }
        .card {
            margin-bottom: 1.5rem;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
        }
        
        /* Custom styles for alerts */
        .alert {
            margin-bottom: 1rem;
        }
        
        /* Loading button state */
        .btn:disabled {
            opacity: 0.65;
        }
        
        /* Modal customization */
        .modal-content {
            border-radius: 0.5rem;
        }
        
        /* Table hover effect */
        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        /* Active menu styling */
        .nav-link.active {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-briefcase me-2"></i>
                JobMatch Admin
            </a>
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-1"></i> Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.applicants') ? 'active' : '' }}" 
                               href="{{ route('admin.applicants') }}">
                                <i class="fas fa-user-tie me-2"></i>
                                Pelamar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.companies') ? 'active' : '' }}" 
                               href="{{ route('admin.companies') }}">
                                <i class="fas fa-building me-2"></i>
                                Perusahaan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.job-postings') ? 'active' : '' }}" 
                               href="{{ route('admin.job-postings') }}">
                                <i class="fas fa-briefcase me-2"></i>
                                Lowongan Kerja
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>
    <!-- jQuery (required for Ajax functionality) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- CSRF Token untuk Ajax -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
    <!-- Scripts tambahan -->
    @stack('scripts')
</body>
</html>