<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - JobMatch</title>
    <meta name="description" content="@yield('description', 'Your personal job matching dashboard')">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom Dashboard Styles -->
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-dark: #1e40af;
            --primary-light: #dbeafe;
            --secondary-color: #8b5cf6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --white-color: #ffffff;
            --navbar-height: 80px;
            --border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding-top: var(--navbar-height);
        }

        /* Enhanced Navbar */
        .dashboard-navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            height: var(--navbar-height);
            z-index: 1050;
        }

        .dashboard-navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 40px rgba(0, 0, 0, 0.15);
        }

        /* Brand Enhancement */
        .dashboard-brand {
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--primary-color);
            text-decoration: none;
            letter-spacing: -0.5px;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .dashboard-brand:hover {
            color: var(--primary-dark);
            transform: scale(1.02);
        }

        .dashboard-brand-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            color: white;
            font-size: 1.1rem;
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
            transition: var(--transition);
        }

        .dashboard-brand:hover .dashboard-brand-icon {
            transform: rotate(5deg) scale(1.05);
            box-shadow: 0 6px 25px rgba(59, 130, 246, 0.5);
        }

        /* Navigation Links Enhancement */
        .navbar-nav .nav-link {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.75rem 1.25rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin: 0 0.25rem;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color);
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
            transform: translateY(-1px);
        }

        .navbar-nav .nav-link.active {
            color: var(--primary-color);
            background: linear-gradient(135deg, var(--primary-light) 0%, rgba(139, 92, 246, 0.1) 100%);
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(59, 130, 246, 0.2);
        }

        .navbar-nav .nav-link i {
            font-size: 1.1rem;
            transition: var(--transition);
        }

        .navbar-nav .nav-link:hover i {
            transform: scale(1.1);
        }

        /* Special styling for Post Job button */
        .btn-post-job {
            background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%) !important;
            color: white !important;
            border: none !important;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3) !important;
            font-weight: 600 !important;
        }

        .btn-post-job:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4) !important;
        }

        /* Enhanced Search Bar */
        .dashboard-search {
            position: relative;
            width: 320px;
            max-width: 100%;
        }

        .dashboard-search input {
            width: 100%;
            padding: 0.75rem 1.25rem 0.75rem 3rem;
            border: 2px solid rgba(226, 232, 240, 0.8);
            border-radius: 25px;
            font-size: 0.9rem;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .dashboard-search input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.15);
            background: white;
            transform: scale(1.02);
        }

        .dashboard-search .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
            transition: var(--transition);
        }

        .dashboard-search input:focus + .search-icon {
            color: var(--primary-color);
        }

        /* Enhanced Notification Bell */
        .notification-bell {
            position: relative;
            padding: 0.75rem;
            border-radius: 12px;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(226, 232, 240, 0.6);
            color: #64748b;
        }

        .notification-bell:hover {
            background: var(--primary-light);
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
        }

        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
            100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        /* Enhanced User Dropdown */
        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 15px;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(226, 232, 240, 0.6);
            cursor: pointer;
        }

        .user-dropdown:hover {
            background: var(--primary-light);
            border-color: var(--primary-color);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            font-weight: 700;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
        }

        .user-info h6 {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 600;
            color: #374151;
        }

        .user-info small {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
        }

        /* Enhanced Dropdown Menus */
        .dropdown-menu {
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            border-radius: 20px;
            padding: 1rem;
            margin-top: 0.75rem;
            min-width: 300px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
        }

        .dropdown-header {
            padding: 1.25rem;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
            border-radius: 15px;
            margin-bottom: 1rem;
            border: 1px solid rgba(59, 130, 246, 0.1);
        }

        .dropdown-item {
            padding: 1rem 1.25rem;
            border-radius: 12px;
            transition: var(--transition);
            font-weight: 500;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.25rem;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
            transform: translateX(8px);
            color: var(--primary-color);
            box-shadow: 0 2px 10px rgba(59, 130, 246, 0.1);
        }

        .dropdown-item.text-danger:hover {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.05) 100%);
            color: var(--danger-color);
            box-shadow: 0 2px 10px rgba(239, 68, 68, 0.1);
        }

        .dropdown-item i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* Notification dropdown enhancements */
        .notification-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 0.5rem 0;
        }

        .notification-item i {
            font-size: 1.2rem;
            margin-top: 2px;
            width: 24px;
            text-align: center;
        }

        .notification-item div p {
            margin-bottom: 0.25rem;
            font-weight: 500;
            color: #374151;
        }

        .notification-item div small {
            color: #64748b;
        }

        /* Mobile Responsive Enhancements */
        @media (max-width: 991.98px) {
            .dashboard-search {
                width: 100%;
                margin: 1rem 0;
            }

            .user-info {
                display: none;
            }

            .navbar-nav {
                padding: 1rem 0;
                gap: 0.5rem;
            }

            .navbar-nav .nav-link {
                padding: 1rem 1.25rem;
                margin: 0.25rem 0;
            }
        }

        @media (max-width: 576px) {
            .dashboard-brand {
                font-size: 1.4rem;
            }

            .dashboard-brand-icon {
                width: 36px;
                height: 36px;
                font-size: 1rem;
            }

            .dashboard-search input {
                padding: 0.75rem 1rem 0.75rem 2.75rem;
            }
        }

        /* Main Content Enhancement */
        .dashboard-content {
            min-height: calc(100vh - var(--navbar-height));
            padding: 2.5rem 0;
        }

        /* Breadcrumb Enhancement */
        .dashboard-breadcrumb .breadcrumb {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 1rem 1.5rem;
            border-radius: 15px;
            box-shadow: var(--box-shadow);
            margin: 0 0 2rem 0;
            border: 1px solid rgba(226, 232, 240, 0.6);
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .breadcrumb-item a:hover {
            color: var(--primary-dark);
        }

        .breadcrumb-item.active {
            color: #64748b;
            font-weight: 500;
        }

        /* Utility Classes */
        .card-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.6);
            border-radius: 20px;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .card-modern:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.12);
        }

        .btn-modern {
            border-radius: var(--border-radius);
            font-weight: 600;
            transition: var(--transition);
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 1.5rem;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        /* Loading Animation */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Smooth scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #7c3aed 100%);
            border-radius: 4px;
        }

        /* Job Card specific styling */
        .job-card {
            background: var(--white-color);
            border: 1px solid rgba(226, 232, 240, 0.6);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            height: 100%; /* Ensure cards in a row have same height */
            display: flex;
            flex-direction: column;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.15);
        }

        .job-card .card-body {
            flex-grow: 1; /* Allow content to grow */
            padding: 1.5rem;
        }

        .job-card .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .job-card .card-subtitle {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 1rem;
        }

        .job-card .card-text {
            font-size: 0.95rem;
            color: #4b5563;
            margin-bottom: 1rem;
        }

        .job-card .job-meta {
            font-size: 0.85rem;
            color: #4b5563;
            margin-bottom: 1rem;
            padding-left: 0;
            list-style: none;
        }

        .job-card .job-meta li {
            margin-bottom: 0.25rem;
        }

        .job-card .job-meta strong {
            color: var(--dark-color);
        }

        /* Custom styles for company profile section */
        .company-profile-card {
            background: var(--white-color);
            border: 1px solid rgba(226, 232, 240, 0.6);
            border-radius: 20px;
            box-shadow: var(--box-shadow);
            padding: 2rem;
            margin-bottom: 2rem; /* Add some space below the profile card */
        }

        .company-profile-card .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .company-profile-card .profile-logo {
            width: 80px;
            height: 80px;
            border-radius: 15px;
            object-fit: contain;
            margin-right: 1.5rem;
            border: 2px solid rgba(59, 130, 246, 0.2);
            padding: 5px;
            background-color: #f0f4f8; /* Light background for logo area */
        }

        .company-profile-card .profile-logo-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 15px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            font-weight: bold;
            margin-right: 1.5rem;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .company-profile-card .profile-info h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }

        .company-profile-card .profile-info p {
            font-size: 0.95rem;
            color: #4b5563;
            margin-bottom: 0.25rem;
        }

        .company-profile-card .profile-info a {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .company-profile-card .profile-info a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .edit-profile-btn {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .edit-profile-btn:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #7c3aed 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Enhanced Dashboard Navbar -->
    <nav class="navbar navbar-expand-lg dashboard-navbar fixed-top" id="dashboardNavbar">
        <div class="container-fluid px-4">
            <!-- Enhanced Brand Logo -->
            <a class="dashboard-brand" href="{{ route('company.dashboard') }}">
                <div class="dashboard-brand-icon">
                    <i class="fas fa-building"></i>
                </div>
                <span class="brand-text">JOBMATCH</span>
                <small class="text-muted ms-2 d-none d-md-inline">Company</small>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardNavContent">
                <i class="fas fa-bars text-primary"></i>
            </button>

            <!-- Main Navigation Content -->
            <div class="collapse navbar-collapse" id="dashboardNavContent">
                <!-- Left Navigation Links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Candidates</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('chat.index') }}" class="nav-link"> {{-- Assuming chat.index route exists --}}
                            <i class="fas fa-comments"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('company.job.create') }}" class="nav-link btn-post-job {{ request()->routeIs('company.job.create') ? 'active' : '' }}">
                            <i class="fas fa-plus-circle"></i>
                            <span>Post Job</span>
                        </a>
                    </li>
                </ul>

                <!-- Right Navigation Elements -->
                <div class="d-flex align-items-center gap-3 ms-auto">
                    <!-- Enhanced Search Bar -->
                    <div class="dashboard-search d-none d-lg-block">
                        <input type="text" placeholder="Search candidates, jobs..." class="form-control">
                        <i class="fas fa-search search-icon"></i>
                    </div>

                    <!-- Enhanced Notifications -->
                    <div class="dropdown">
                        <button class="btn notification-bell" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">5</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Notifications</h6>
                                    <small class="text-primary">Mark all read</small>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="notification-item">
                                        <i class="fas fa-user-plus text-success"></i>
                                        <div>
                                            <p>New application received</p>
                                            <small class="text-muted">John Doe applied for Software Engineer</small>
                                            <small class="text-muted d-block">2 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="notification-item">
                                        <i class="fas fa-star text-warning"></i>
                                        <div>
                                            <p>Job posting approved</p>
                                            <small class="text-muted">Your Frontend Developer position is now live</small>
                                            <small class="text-muted d-block">1 hour ago</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="notification-item">
                                        <i class="fas fa-envelope text-info"></i>
                                        <div>
                                            <p>Message from candidate</p>
                                            <small class="text-muted">Sarah Johnson sent you a message</small>
                                            <small class="text-muted d-block">3 hours ago</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center text-primary" href="#">View all notifications</a></li>
                        </ul>
                    </div>

                    <!-- Enhanced User Dropdown -->
                    <div class="dropdown">
                        <button class="btn user-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar">
                                {{ substr(Auth::user()->name ?? 'C', 0, 1) }}
                            </div>
                            <div class="user-info d-none d-md-block">
                                <h6>{{ Auth::user()->name ?? 'Company' }}</h6>
                                <small>{{ ucfirst(Auth::user()->role ?? 'Company') }}</small>
                            </div>
                            <i class="fas fa-chevron-down text-muted ms-2"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-3">
                                        {{ substr(Auth::user()->name ?? 'C', 0, 1) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ Auth::user()->name ?? 'Company' }}</h6>
                                        <small class="text-muted">{{ Auth::user()->email ?? 'company@example.com' }}</small>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                {{-- Rute yang diperbaiki: 'companies.edit' --}}
                                <a class="dropdown-item" href="{{ route('companies.edit', $company->id) }}">
                                    <i class="fas fa-building"></i>Company Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-chart-bar"></i>Analytics
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-credit-card"></i>Billing & Plans
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog"></i>Settings
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-question-circle"></i>Help & Support
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/') }}">
                                    <i class="fas fa-home"></i>Back to Main Site
                                </a>
                            </li>
                            <li>
                                {{-- Pastikan rute logout ini mengarah ke logout perusahaan --}}
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
        </div>
    </nav>

    <!-- Main Content -->
    <main class="dashboard-content">
        <div class="container-fluid px-4">
            <!-- Enhanced Breadcrumb -->
            @if(!request()->routeIs('company.dashboard'))
            <nav class="dashboard-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('company.dashboard') }}">
                            <i class="fas fa-home me-1"></i>Dashboard
                        </a>
                    </li>
                    @yield('breadcrumb')
                </ol>
            </nav>
            @endif

            {{-- Bagian Konten Dinamis Dimulai Di Sini --}}

            {{-- Pesan Sukses/Error dari Session --}}
            @if (session('success'))
                <div class="alert alert-success card-modern alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger card-modern alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Bagian Profil Perusahaan --}}
            <div class="company-profile-card mb-5">
                <div class="profile-header">
                    @if ($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo Perusahaan" class="profile-logo">
                    @else
                        <div class="profile-logo-placeholder">
                            {{ substr($company->company_name, 0, 1) }}
                        </div>
                    @endif
                    <div class="profile-info">
                        <h3>{{ $company->company_name }}</h3>
                        <p><i class="fas fa-envelope me-2"></i>{{ $company->company_email }}</p>
                        <p><i class="fas fa-phone me-2"></i>{{ $company->company_phone_number }}</p>
                        <p><i class="fas fa-map-marker-alt me-2"></i>{{ $company->company_address }}</p>
                        @if ($company->website_address)
                            <p><i class="fas fa-globe me-2"></i><a href="{{ $company->website_address }}" target="_blank">{{ $company->website_address }}</a></p>
                        @endif
                    </div>
                </div>
                {{-- Link untuk mengedit profil perusahaan. Menggunakan rute yang benar: 'companies.edit' --}}
                <a href="{{ route('companies.edit', $company->id) }}" class="btn edit-profile-btn">
                    <i class="fas fa-pencil-alt"></i> Edit Profil Perusahaan
                </a>
                
            </div>

            <!-- Page Content (Lowongan Pekerjaan Perusahaan) -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h5 mb-0">Lowongan Pekerjaan Anda</h2>
                <a href="{{ route('company.job.create') }}" class="btn btn-primary btn-modern">
                    <i class="fas fa-plus-circle me-2"></i> Post Lowongan Baru
                </a>
            </div>

            @if($jobs->isEmpty())
                <div class="alert alert-info card-modern p-4 text-center">
                    <p class="mb-0"><i class="fas fa-info-circle me-2"></i> Anda belum memposting lowongan pekerjaan.</p>
                    <p class="mb-0 mt-2">Klik "Post Lowongan Baru" untuk memulai!</p>
                </div>
            @else
                <div class="row">
                    @foreach($jobs as $job)
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="card job-card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $job->title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $job->location }}
                                        <span class="mx-2">|</span>
                                        <i class="fas fa-briefcase me-1"></i>{{ $job->type_of_work }}
                                    </h6>
                                    <p class="card-text">{{ Str::limit($job->job_description ?? 'Tidak ada deskripsi tersedia.', 150) }}</p>
                                    <ul class="list-unstyled job-meta">
                                        <li><strong><i class="fas fa-tag me-2"></i>Bidang:</strong> {{ $job->bidang }}</li>
                                        <li><strong><i class="fas fa-money-bill-wave me-2"></i>Gaji:</strong> Rp{{ number_format($job->gaji_min, 0, ',', '.') }} - Rp{{ number_format($job->gaji_max, 0, ',', '.') }}</li>
                                        <li><strong><i class="fas fa-calendar-alt me-2"></i>Diposting:</strong> {{ $job->created_at->diffForHumans() }}</li>
                                    </ul>
                                    <div class="d-flex justify-content-end align-items-center gap-2 mt-3">
                                        
                                        {{-- Rute yang diperbaiki: 'jobs.edit' menunjuk ke JobController@edit --}}
                                        <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-sm btn-warning btn-modern">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        {{-- Rute yang diperbaiki: 'jobs.destroy' menunjuk ke JobController@destroy --}}
                                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-modern">
                                                <i class="fas fa-trash-alt me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Enhanced Dashboard JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced navbar scroll effect
            const navbar = document.getElementById('dashboardNavbar');

            // Add scrolled class on page load if not at top
            if (window.scrollY > 0) {
                navbar.classList.add('scrolled');
            }

            // Add/remove scrolled class on scroll
            window.addEventListener('scroll', function() {
                if (window.scrollY > 0) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Smooth scroll for anchor links (if any)
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Enhanced search functionality (example - needs backend implementation)
            const searchInput = document.querySelector('.dashboard-search input');
            if (searchInput) {
                let searchTimeout;
                
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    const searchTerm = this.value.trim();
                    
                    if (searchTerm.length > 2) { // Only search after 2 characters
                        searchTimeout = setTimeout(() => {
                            console.log('Searching for:', searchTerm);
                            // TODO: Implement actual AJAX search or redirect to search results page
                        }, 300); // Debounce for 300ms
                    }
                });

                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const searchTerm = this.value.trim();
                        if (searchTerm) {
                            // Redirect to search results page (example route)
                            window.location.href = `/company/search?q=${encodeURIComponent(searchTerm)}`;
                        }
                    }
                });
            }

            // Auto-hide notifications (example - needs dynamic content and dismiss logic)
            setTimeout(() => {
                const notifications = document.querySelectorAll('.notification-item');
                notifications.forEach(notification => {
                    notification.addEventListener('click', function() {
                        // Example: Visually "dim" the notification when clicked
                        this.style.opacity = '0.5';
                        console.log('Notification clicked and dimmed.');
                        // TODO: Implement actual mark-as-read or dismiss logic
                    });
                });
            }, 1000); // Example: Add a slight delay for aesthetic

            // Enhanced dropdown behavior (example - Bootstrap handles most of this)
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('[data-bs-toggle="dropdown"]');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                // Bootstrap's JS handles dropdown visibility, this is for custom animation
                toggle.addEventListener('click', function() {
                    if (menu) {
                        menu.style.animation = 'fadeInUp 0.3s ease forwards'; // 'forwards' keeps the end state
                    }
                });

                // Reset animation on close (optional, Bootstrap re-hides it)
                dropdown.addEventListener('hide.bs.dropdown', function () {
                    if (menu) {
                        menu.style.animation = ''; // Clear animation style
                    }
                });
            });

            // Update notification count example (needs real data)
            // updateNotificationCount(3); // Example call to update the badge

            console.log('JobMatch Company Dashboard initialized successfully!');
        });

        // Utility functions (examples)
        function showToast(message, type = 'success') {
            // Placeholder for a toast notification system
            console.log(`Toast: ${message} (${type})`);
            // You would typically use a library or custom component here
            // e.g., Bootstrap Toasts, SweetAlert2, or a custom div
        }

        function updateNotificationCount(count) {
            const badge = document.querySelector('.notification-badge');
            if (badge) {
                badge.textContent = count;
                badge.style.display = count > 0 ? 'flex' : 'none'; // Show if count > 0
                
                if (count > 0) {
                    badge.style.animation = 'pulse 2s infinite'; // Animate if new notifications
                } else {
                    badge.style.animation = ''; // Stop animation if no notifications
                }
            }
        }

        // Add CSS animation keyframes for dropdowns
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    </script>

    @stack('scripts')
</body>
</html>
