<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JobMatch Profile</title>
    <meta name="description" content="Your personal job matching dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom Dashboard Styles & Profile Specific Styles -->
    <style>
        :root {
            --primary-color: #5B7D87; 
            --primary-dark: #2B4251;
            --primary-light: #dbeafe;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --navbar-height: 70px;
            --sidebar-width: 0px; /* No sidebar in this layout */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            font-weight: 400;
            line-height: 1.6;
            color: #374151;
            background-color: #f8fafc;
            padding-top: var(--navbar-height); /* Ensure content is below fixed navbar */
        }

        /* Dashboard Navbar Styles */
        .dashboard-navbar {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: var(--navbar-height);
            z-index: 1050;
        }

        .dashboard-navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.12);
        }

        /* Brand Section */
        .dashboard-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary-color);
            text-decoration: none;
            letter-spacing: -0.5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .dashboard-brand:hover {
            color: var(--primary-dark);
            transform: scale(1.02);
        }

        .dashboard-brand-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--light-color) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            color: white;
            font-size: 1rem;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        /* Dashboard Navigation Links */
        .dashboard-nav-links {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .dashboard-nav-link {
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .dashboard-nav-link:hover {
            color: var(--primary-color);
            background: rgba(59, 130, 246, 0.08);
            transform: translateY(-1px);
        }

        .dashboard-nav-link.active {
            color: var(--primary-color);
            background: var(--primary-light);
            font-weight: 600;
        }

        .dashboard-nav-link i {
            font-size: 1rem;
        }

        /* Search Bar */
        .dashboard-search {
            position: relative;
            width: 300px;
            max-width: 100%;
        }

        .dashboard-search input {
            width: 100%;
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .dashboard-search input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.15);
            background: white;
        }

        .dashboard-search .search-icon {
            position: absolute;
            left: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 0.9rem;
        }

        /* Notification Bell */
        .notification-bell {
            position: relative;
            padding: 0.5rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid #e5e7eb;
        }

        .notification-bell:hover {
            background: var(--primary-light);
            border-color: var(--primary-color);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* User Dropdown */
        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0.8rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid #e5e7eb;
            cursor: pointer;
        }

        .user-dropdown:hover {
            background: var(--primary-light);
            border-color: var(--primary-color);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--success-color) 0%, #065f46 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            /* Added for the profile image */
            overflow: hidden; 
        }
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        .user-info h6 {
            margin: 0;
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
        }

        .user-info span {
            font-size: 0.75rem;
            color: #6b7280;
        }

        .text-primary-custom {
            color: var(--primary-color) !important;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border-radius: 15px;
            padding: 0.5rem;
            margin-top: 0.5rem;
            min-width: 280px;
        }

        .dropdown-header {
            padding: 1rem;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
            border-radius: 10px;
            margin-bottom: 0.5rem;
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .dropdown-item:hover {
            background: rgba(59, 130, 246, 0.1);
            transform: translateX(5px);
            color: var(--primary-color);
        }

        .dropdown-item.text-danger:hover {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .btn-navbar-solid {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-navbar-solid:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
            color: white;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .mobile-menu-toggle:hover {
            background: rgba(59, 130, 246, 0.1);
        }

        .mobile-menu-toggle i {
            font-size: 1.2rem;
            color: var(--primary-color);
        }

        /* Mobile Responsive */
        @media (max-width: 991.98px) {
            .dashboard-nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 1rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                border-radius: 0 0 15px 15px;
                gap: 0.5rem;
            }

            .dashboard-nav-links.show {
                display: flex;
            }

            .dashboard-search {
                width: 100%;
                margin: 0.5rem 0;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .user-info {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .dashboard-brand {
                font-size: 1.25rem;
            }

            .dashboard-brand-icon {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
            }
        }

        /* Main Content */
        .dashboard-content {
            min-height: calc(100vh - var(--navbar-height));
            padding: 2rem 0;
        }

        /* Breadcrumb (Not used in this specific profile page, but kept for consistency with dashboard styles) */
        .dashboard-breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
        }

        .dashboard-breadcrumb .breadcrumb {
            background: white;
            padding: 0.8rem 1.2rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item.active {
            color: #6b7280;
            font-weight: 500;
        }

        /* Utility Classes */
        .card-modern {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .btn-modern {
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-modern:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        /* Quick Stats Cards (Not directly used but keeping for shared style consistency) */
        .stats-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--light-color) 100%);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.3);
        }

        .stats-card.success {
            background: linear-gradient(135deg, var(--success-color) 0%, #065f46 100%);
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.3);
        }

        .stats-card.warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #92400e 100%);
            box-shadow: 0 4px 20px rgba(245, 158, 11, 0.3);
        }
        
        /* Profile specific styles */
        .profile-card {
            background-color: #2c3e50; /* A dark blue-grey from your original profile card */
            color: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Added shadow for consistency with dashboard cards */
        }
        /* Adjusted for the profile picture within the main profile card */
        .profile-card .profile-pic {
            width: 100px; /* Larger size for the main profile picture */
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        .profile-card .profile-pic:hover {
            transform: scale(1.05);
        }
        .profile-details p {
            margin-bottom: 0.5rem;
        }
        .profile-details i {
            width: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Dashboard Navbar -->
    <nav class="navbar navbar-expand-lg dashboard-navbar fixed-top" id="dashboardNavbar">
        <div class="container-fluid px-4">
            <!-- Brand -->
            <a class="dashboard-brand" href="{{ route('applicant.dashboard') }}">
                <div class="dashboard-brand-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                JOBMATCH
            </a>

            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" type="button" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Navigation Links -->
            <div class="dashboard-nav-links" id="dashboardNavLinks">
                <a href="{{ route('applicant.dashboard') }}" class="dashboard-nav-link {{ request()->routeIs('applicant.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('community.index') }}" class="dashboard-nav-link {{ request()->routeIs('community.index') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Community</span>
                </a>

                <a href="{{ route('jobs.index') }}" class="dashboard-nav-link {{ request()->routeIs('jobs.index') ? 'active' : '' }}">
                    <i class="fas fa-search"></i>
                    <span>Find Jobs</span>
                </a>
                
                <a href="#" class="dashboard-nav-link">
                    <i class="fas fa-file-alt"></i>
                    <span>My Applications</span>
                </a>
                <a href="{{ route('chat.index') }}" class="dashboard-nav-link {{ request()->routeIs('chat.index') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i>
                    <span>Messages</span>
                </a>
                <a href="{{ route('bookmark.index') }}" class="dashboard-nav-link {{ request()->routeIs('bookmark.index') ? 'active' : '' }}">
                    <i class="fas fa-bookmark"></i>
                    <span>Saved Jobs</span>
                </a>
            </div>

            <!-- Right Section -->
            <div class="d-flex align-items-center gap-3">
                <!-- Search Bar -->
                <div class="dashboard-search d-none d-lg-block">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" placeholder="Search jobs..." class="form-control">
                </div>

                <!-- Notifications -->
                <div class="notification-bell" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell text-muted"></i>
                    <span class="notification-badge">3</span>
                </div>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><h6 class="dropdown-header">Notifications</h6></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-briefcase text-primary"></i>New job match found</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-check-circle text-success"></i>Application accepted</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-envelope text-info"></i>New message from company</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-center" href="#">View all notifications</a></li>
                </ul>

                <!-- User Dropdown -->
                <div class="dropdown">
                    <div class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar">
                            @if($applicant->photo)
                                <img src="{{ asset('storage/' . $applicant->photo) }}?v={{ $applicant->updated_at ? $applicant->updated_at->timestamp : now()->timestamp }}" alt="Profil">
                            @else
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            @endif
                        </div>
                        <div class="user-info d-none d-md-block">
                            <h6>{{ Auth::user()->name ?? 'User' }}</h6>
                            <span>Job Seeker</span>
                        </div>
                        <i class="fas fa-chevron-down text-muted ms-1"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-header">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-3">
                                    @if($applicant->photo)
                                        <img src="{{ asset('storage/' . $applicant->photo) }}?v={{ $applicant->updated_at ? $applicant->updated_at->timestamp : now()->timestamp }}" alt="Profil">
                                    @else
                                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                                    @endif
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ Auth::user()->name ?? 'User' }}</h6>
                                    <small class="text-muted">{{ Auth::user()->email ?? 'user@example.com' }}</small>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user"></i>My Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-file-alt"></i>My Resume</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i>Account Settings</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-question-circle"></i>Help & Support</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('/') }}"><i class="fas fa-home"></i>Back to Main Site</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="dashboard-content">
        <div class="container-fluid px-4">
            <div class="profile-card p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-2">{{ $applicant->name ?? 'Nama Tidak Diketahui' }}</h5>
                    <p class="mb-1"><i class="bi bi-geo-alt-fill me-2"></i>{{ $applicant->address ?? 'Alamat Tidak Diketahui' }}</p>
                    <p><i class="bi bi-envelope-fill me-2"></i>{{ $applicant->email ?? 'Email Tidak Diketahui' }}</p>
                    <button class="btn btn-outline-light mt-2" onclick="toggleEditForm()">Edit</button>
                </div>
                
                {{-- FOTO PROFIL DI PROFILE CARD (Menggunakan data applicant) --}}
                {{-- Menambahkan parameter v untuk cache-busting --}}
                <img src="{{ asset('storage/' . ($applicant->photo ?? 'default_profile.png')) }}?v={{ $applicant->updated_at ? $applicant->updated_at->timestamp : now()->timestamp }}" class="profile-pic" alt="Profile">
            </div>

            {{-- Detail Profil Tambahan (Bagian Tampilan) --}}
            <div class="bg-white p-4 mt-3 rounded shadow-sm profile-details card-modern">
                <h5 class="fw-bold mb-3">Detail Pribadi</h5>
                <p><i class="bi bi-person-fill me-2"></i>Nama Panggilan: {{ $applicant->name ?? '-' }}</p>
                <p><i class="bi bi-person-fill me-2"></i>Nama Lengkap: {{ $applicant->full_name ?? '-' }}</p>
                <p><i class="bi bi-phone-fill me-2"></i>Nomor Telepon: {{ $applicant->phone_number ?? '-' }}</p>
                <p><i class="bi bi-calendar-date-fill me-2"></i>Tanggal Lahir: {{ $applicant->date_of_birth ? \Carbon\Carbon::parse($applicant->date_of_birth)->format('d F Y') : '-' }}</p>
                <p><i class="bi bi-person-fill me-2"></i>Jenis Kelamin: {{ $applicant->gender ?? '-' }}</p>
                <p><i class="bi bi-building-fill me-2"></i>Institusi: {{ $applicant->institution ?? '-' }}</p>
                <p><i class="bi bi-book-fill me-2"></i>Jurusan: {{ $applicant->major ?? '-' }}</p>
                <p><i class="bi bi-calendar-check-fill me-2"></i>Tahun Kelulusan: {{ $applicant->graduation_year ?? '-' }}</p>
                <p><i class="bi bi-lightbulb-fill me-2"></i>Soft Skills: {{ $applicant->soft_skills ?? '-' }}</p>
                <p><i class="bi bi-star-fill me-2"></i>Hard Skills: {{ $applicant->hard_skills ?? '-' }}</p>
                <p><i class="bi bi-briefcase-fill me-2"></i>Posisi yang Diinginkan: {{ $applicant->desired_position ?? '-' }}</p>
                
                <h5 class="fw-bold mb-3 mt-4">Pengalaman Kerja & Preferensi</h5>
                <p><i class="bi bi-building-fill-add me-2"></i>Perusahaan Sebelumnya: {{ $applicant->work_company ?? '-' }}</p>
                <p><i class="bi bi-person-badge-fill me-2"></i>Posisi Sebelumnya: {{ $applicant->work_position ?? '-' }}</p>
                <p><i class="bi bi-journal-text me-2"></i>Deskripsi Pekerjaan: {{ $applicant->work_description ?? '-' }}</p>
                
                @if($applicant->certification)
                    <p><i class="bi bi-patch-check-fill me-2"></i>Sertifikasi: <a href="{{ asset('storage/' . $applicant->certification) }}" target="_blank">Lihat Sertifikasi</a></p>
                @else
                    <p><i class="bi bi-patch-check-fill me-2"></i>Sertifikasi: -</p>
                @endif
                
                <p><i class="bi bi-gear-fill me-2"></i>Tipe Pekerjaan: {{ $applicant->type_of_work ?? '-' }}</p>
                <p><i class="bi bi-geo-alt-fill me-2"></i>Lokasi Bekerja: {{ $applicant->location ?? '-' }}</p>
                <p><i class="bi bi-cash-stack me-2"></i>Rentang Gaji (Min): Rp {{ number_format($applicant->salary_min ?? 0, 0, ',', '.') }}</p>
                <p><i class="bi bi-cash-stack me-2"></i>Rentang Gaji (Max): Rp {{ number_format($applicant->salary_max ?? 0, 0, ',', '.') }}</p>
                <p><i class="bi bi-calendar-event-fill me-2"></i>Tanggal Ketersediaan: {{ $applicant->availability_date ? \Carbon\Carbon::parse($applicant->availability_date)->format('Y-m-d') : '-' }}</p>

                {{-- Link CV --}}
                @if($applicant->cv_file)
                    <p><i class="bi bi-file-earmark-text-fill me-2"></i>CV: <a href="{{ asset('storage/' . $applicant->cv_file) }}" target="_blank">Lihat CV</a></p>
                @else
                    <p><i class="bi bi-file-earmark-text-fill me-2"></i>CV: -</p>
                @endif

                {{-- Link Portfolio --}}
                @if($applicant->portfolio_file)
                    <p><i class="bi bi-folder-fill me-2"></i>Portfolio: <a href="{{ asset('storage/' . $applicant->portfolio_file) }}" target="_blank">Lihat Portfolio</a></p>
                @else
                    <p><i class="bi bi-folder-fill me-2"></i>Portfolio: -</p>
                @endif
            </div>

            {{-- FORM EDIT --}}
            <div id="editForm" class="bg-white p-4 mt-3 rounded shadow-sm d-none card-modern">
                <h5 class="fw-bold mb-3">Edit Detail Pribadi</h5>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Whoops! Ada Kesalahan!</strong> Mohon periksa kembali input Anda.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Panggilan --}}
                    <div class="mb-3">
                        <label for="nickname" class="form-label">Nama Panggilan</label>
                        <input type="text" class="form-control" id="nickname" name="name" value="{{ old('name', $applicant->name ?? '') }}" required>
                        @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Nama Lengkap --}}
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" value="{{ old('full_name', $applicant->full_name ?? '') }}" required>
                        @error('full_name')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $applicant->email ?? ($user->email ?? '')) }}" required>
                        @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Phone Number --}}
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone_number" value="{{ old('phone_number', $applicant->phone_number ?? '') }}" required>
                        @error('phone_number')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Address --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $applicant->address ?? '') }}" required>
                        @error('address')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $applicant->date_of_birth ? \Carbon\Carbon::parse($applicant->date_of_birth)->format('Y-m-d') : '') }}" required>
                        @error('date_of_birth')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="male" {{ (old('gender', $applicant->gender ?? '') == 'male') ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ (old('gender', $applicant->gender ?? '') == 'female') ? 'selected' : '' }}>Perempuan</option>
                            <option value="other" {{ (old('gender', $applicant->gender ?? '') == 'other') ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('gender')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Institusi --}}
                    <div class="mb-3">
                        <label for="institution" class="form-label">Institusi</label>
                        <input type="text" class="form-control" id="institution" name="institution" value="{{ old('institution', $applicant->institution ?? '') }}" required>
                        @error('institution')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Jurusan --}}
                    <div class="mb-3">
                        <label for="major" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="major" name="major" value="{{ old('major', $applicant->major ?? '') }}" required>
                        @error('major')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Tahun Kelulusan --}}
                    <div class="mb-3">
                        <label for="graduation_year" class="form-label">Tahun Kelulusan</label>
                        <input type="number" class="form-control" id="graduation_year" name="graduation_year" value="{{ old('graduation_year', $applicant->graduation_year ?? '') }}" min="1900" max="{{ date('Y') + 5 }}" required>
                        @error('graduation_year')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Soft Skills --}}
                    <div class="mb-3">
                        <label for="soft_skills" class="form-label">Soft Skills</label>
                        <textarea class="form-control" id="soft_skills" name="soft_skills" rows="3">{{ old('soft_skills', $applicant->soft_skills ?? '') }}</textarea>
                        <small class="form-text text-muted">Pisahkan dengan koma jika ada beberapa skill.</small>
                        @error('soft_skills')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Hard Skills --}}
                    <div class="mb-3">
                        <label for="hard_skills" class="form-label">Hard Skills</label>
                        <textarea class="form-control" id="hard_skills" name="hard_skills" rows="3">{{ old('hard_skills', $applicant->hard_skills ?? '') }}</textarea>
                        <small class="form-text text-muted">Pisahkan dengan koma jika ada beberapa skill.</small>
                        @error('hard_skills')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                    
                    {{-- Posisi yang Diinginkan (Ditambahkan Kembali) --}}
                    <div class="mb-3">
                        <label for="desired_position" class="form-label">Posisi yang Diinginkan</label>
                        <input type="text" class="form-control" id="desired_position" name="desired_position" value="{{ old('desired_position', $applicant->desired_position ?? '') }}" required>
                        @error('desired_position')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Bagian Pengalaman Kerja & Preferensi --}}
                    <h5 class="fw-bold mb-3 mt-4">Edit Pengalaman Kerja & Preferensi</h5>
                    
                    {{-- Work Company --}}
                    <div class="mb-3">
                        <label for="work_company" class="form-label">Perusahaan Sebelumnya</label>
                        <input type="text" class="form-control" id="work_company" name="work_company" value="{{ old('work_company', $applicant->work_company ?? '') }}" required>
                        @error('work_company')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Work Position --}}
                    <div class="mb-3">
                        <label for="work_position" class="form-label">Posisi Sebelumnya</label>
                        <input type="text" class="form-control" id="work_position" name="work_position" value="{{ old('work_position', $applicant->work_position ?? '') }}" required>
                        @error('work_position')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Work Description --}}
                    <div class="mb-3">
                        <label for="work_description" class="form-label">Deskripsi Pekerjaan</label>
                        <textarea class="form-control" id="work_description" name="work_description" rows="3">{{ old('work_description', $applicant->work_description ?? '') }}</textarea>
                        @error('work_description')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Certification File --}}
                    <div class="mb-3">
                        <label for="certification" class="form-label">Sertifikasi (PDF)</label>
                        <input class="form-control" type="file" id="certification" name="certification">
                        @if($applicant->certification)
                            <small class="text-muted">Sertifikasi Saat Ini: <a href="{{ asset('storage/' . $applicant->certification) }}" target="_blank">Lihat</a></small>
                        @endif
                        @error('certification')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Type of Work --}}
                    <div class="mb-3">
                        <label for="type_of_work" class="form-label">Tipe Pekerjaan</label>
                        <select class="form-select" id="type_of_work" name="type_of_work" required>
                            <option value="">Pilih Tipe Pekerjaan</option>
                            <option value="Full-Time" {{ (old('type_of_work', $applicant->type_of_work ?? '') == 'Full-Time') ? 'selected' : '' }}>Full-Time</option>
                            <option value="Part-Time" {{ (old('type_of_work', $applicant->type_of_work ?? '') == 'Part-Time') ? 'selected' : '' }}>Part-Time</option>
                            <option value="Remote" {{ (old('type_of_work', $applicant->type_of_work ?? '') == 'Remote') ? 'selected' : '' }}>Remote</option>
                            <option value="Freelance" {{ (old('type_of_work', $applicant->type_of_work ?? '') == 'Freelance') ? 'selected' : '' }}>Freelance</option>
                            <option value="Internship" {{ (old('type_of_work', $applicant->type_of_work ?? '') == 'Internship') ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('type_of_work')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Location --}}
                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi Bekerja</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $applicant->location ?? '') }}" required>
                        @error('location')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        {{-- Salary Min --}}
                        <div class="col-md-6 mb-3">
                            <label for="salary_min" class="form-label">Gaji Minimum (IDR)</label>
                            <input type="number" class="form-control" id="salary_min" name="salary_min" value="{{ old('salary_min', $applicant->salary_min ?? '') }}" min="0" required>
                            @error('salary_min')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>

                        {{-- Salary Max --}}
                        <div class="col-md-6 mb-3">
                            <label for="salary_max" class="form-label">Gaji Maksimum (IDR)</label>
                            <input type="number" class="form-control" id="salary_max" name="salary_max" value="{{ old('salary_max', $applicant->salary_max ?? '') }}" min="0" required>
                            @error('salary_max')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Availability Date --}}
                    <div class="mb-3">
                        <label for="availability_date" class="form-label">Tanggal Ketersediaan</label>
                        <input type="date" class="form-control" id="availability_date" name="availability_date" value="{{ old('availability_date', $applicant->availability_date ? \Carbon\Carbon::parse($applicant->availability_date)->format('Y-m-d') : '') }}" required>
                        @error('availability_date')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="row">
                        {{-- CV File --}}
                        <div class="col-md-6 mb-3">
                            <label for="cv" class="form-label">CV</label>
                            <input class="form-control" type="file" id="cv" name="cv_file">
                            @if($applicant->cv_file)
                                <small class="text-muted">CV Saat Ini: <a href="{{ asset('storage/' . $applicant->cv_file) }}" target="_blank">Lihat</a></small>
                            @endif
                            @error('cv_file')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>

                        {{-- Portfolio File --}}
                        <div class="col-md-6 mb-3">
                            <label for="portfolio" class="form-label">Portofolio</label>
                            <input class="form-control" type="file" id="portfolio" name="portfolio_file">
                            @if($applicant->portfolio_file)
                                <small class="text-muted">Portofolio Saat Ini: <a href="{{ asset('storage/' . $applicant->portfolio_file) }}" target="_blank">Lihat</a></small>
                            @endif
                            @error('portfolio_file')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    
                    {{-- Photo Profile --}}
                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto Profil</label>
                        <input class="form-control" type="file" id="photo" name="photo">
                        @if($applicant->photo)
                            <small class="text-muted">Foto Saat Ini: <img src="{{ asset('storage/' . $applicant->photo) }}" alt="Current Profile" class="profile-pic" style="width: 50px; height: 50px;"></small>
                        @endif
                        @error('photo')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-modern">Simpan</button>
                </form>
            </div>
        </div>
    </main>

    <footer class="border-top py-3 text-center text-muted small">
        <a href="#" class="me-3 text-decoration-none text-muted">Syarat & Ketentuan</a>
        <a href="#" class="me-3 text-decoration-none text-muted">Keamanan & Privasi</a>
        <a href="#" class="text-decoration-none text-muted">Pusat Bantuan</a>
    </footer>

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Custom Dashboard JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navbar scroll effect
            const navbar = document.getElementById('dashboardNavbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Search functionality (placeholder)
            const searchInput = document.querySelector('.dashboard-search input');
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        const searchTerm = this.value.trim();
                        if (searchTerm) {
                            console.log('Searching for:', searchTerm);
                            // Implement search functionality here (e.g., redirect or filter)
                        }
                    }
                });
            }

            console.log('JobMatch Profile Page with Dashboard Navbar initialized successfully!');
        });

        // Mobile menu toggle
        function toggleMobileMenu() {
            const navLinks = document.getElementById('dashboardNavLinks');
            navLinks.classList.toggle('show');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            const navLinks = document.getElementById('dashboardNavLinks');
            const toggleButton = document.querySelector('.mobile-menu-toggle');
            
            // Check if the clicked element is outside the nav links and outside the toggle button
            if (!navLinks.contains(e.target) && !toggleButton.contains(e.target)) {
                navLinks.classList.remove('show');
            }
        });

        // Notification handling (placeholder)
        function markNotificationAsRead(notificationId) {
            console.log('Marking notification as read:', notificationId);
        }

        // Real-time notifications (placeholder, integrate with WebSocket or polling if needed)
        function updateNotificationCount(count) {
            const badge = document.querySelector('.notification-badge');
            if (badge) {
                badge.textContent = count;
                badge.style.display = count > 0 ? 'flex' : 'none';
            }
        }

        // Script for profile edit form
        function toggleEditForm() {
            const form = document.getElementById("editForm");
            form.classList.toggle("d-none");
        }

        @if(session('success'))
            const successMessage = {{ Js::from(session('success')) }};
            const successAlert = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${successMessage}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            document.getElementById('editForm').insertAdjacentHTML('afterbegin', successAlert);
            document.getElementById("editForm").classList.remove("d-none");
        @endif

        @if ($errors->any())
            document.getElementById("editForm").classList.remove("d-none");
        @endif
    </script>
</body>
</html>
