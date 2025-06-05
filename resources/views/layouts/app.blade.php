<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JobMatch - @yield('title', 'Find Your Perfect Match')</title>
    <meta name="description" content="@yield('description', 'Connect talented professionals with amazing companies. JobMatch is the premier platform for recruitment and job searching in Indonesia.')">
    
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
    
    <!-- Custom Styles -->
    <style>
        /* Semua CSS style Anda tetap sama seperti sebelumnya */
        :root {
            --primary-color: #5B7D87;
            --primary-dark: #2B4251;
            --primary-light: #F5F5F5;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --navbar-height: 80px;
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
            background-color: #ffffff;
            padding-top: var(--navbar-height);
        }

        /* Hide navbar padding on login pages */
        body.no-navbar {
            padding-top: 0;
        }

        /* Semua CSS lainnya tetap sama... */
        .navbar-modern {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: var(--navbar-height);
            z-index: 1050;
        }

        .navbar-modern.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .navbar-brand-modern {
            font-weight: 800;
            font-size: 1.75rem;
            color: var(--primary-color) !important;
            text-decoration: none;
            letter-spacing: -0.5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .navbar-brand-modern:hover {
            color: var(--primary-dark) !important;
            transform: scale(1.02);
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .nav-link-modern {
            color: #374151 !important;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.75rem 1rem !important;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            margin: 0 0.25rem;
        }

        .nav-link-modern:hover {
            color: var(--primary-color) !important;
            background: rgba(59, 130, 246, 0.08);
            transform: translateY(-1px);
        }

        .nav-link-modern.active {
            color: var(--primary-color) !important;
            background: rgba(59, 130, 246, 0.1);
            font-weight: 600;
        }

        .nav-link-modern::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link-modern:hover::after,
        .nav-link-modern.active::after {
            width: 70%;
        }

        /* Navigation Switcher */
        .nav-switcher {
            display: none;
        }

        @media (min-width: 992px) {
            .nav-switcher {
                display: block;
            }
        }

        .switcher-container {
            display: flex;
            align-items: center;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 25px;
            padding: 0.5rem 1rem;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .switcher-label {
            font-size: 0.8rem;
            color: #6b7280;
            font-weight: 500;
            margin-right: 0.5rem;
        }

        .switcher-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .switcher-active {
            background: var(--primary-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .switcher-option {
            color: #6b7280;
            text-decoration: none;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .switcher-option:hover {
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary-color);
        }

        /* Dropdown Styles */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border-radius: 15px;
            padding: 0.5rem;
            margin-top: 0.5rem;
            min-width: 250px;
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

        .user-avatar {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .user-avatar-small {
            font-size: 2rem;
        }

        /* CTA Buttons in Navbar */
        .btn-navbar {
            padding: 0.5rem 1.25rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid;
            font-size: 0.9rem;
        }

        .btn-navbar-outline {
            color: var(--primary-color);
            border-color: var(--primary-color);
            background: transparent;
        }

        .btn-navbar-outline:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
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

        /* Mobile Menu */
        .navbar-toggler-modern {
            border: none;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-toggler-modern:focus {
            box-shadow: none;
        }

        .navbar-toggler-modern:hover {
            background: rgba(59, 130, 246, 0.1);
        }

        .navbar-toggler-icon-modern {
            width: 24px;
            height: 2px;
            background: var(--primary-color);
            border-radius: 2px;
            position: relative;
            transition: all 0.3s ease;
        }

        .navbar-toggler-icon-modern::before,
        .navbar-toggler-icon-modern::after {
            content: '';
            position: absolute;
            width: 24px;
            height: 2px;
            background: var(--primary-color);
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .navbar-toggler-icon-modern::before {
            top: -8px;
        }

        .navbar-toggler-icon-modern::after {
            bottom: -8px;
        }

        .navbar-toggler-modern.collapsed .navbar-toggler-icon-modern {
            background: transparent;
        }

        .navbar-toggler-modern.collapsed .navbar-toggler-icon-modern::before {
            transform: rotate(45deg);
            top: 0;
        }

        .navbar-toggler-modern.collapsed .navbar-toggler-icon-modern::after {
            transform: rotate(-45deg);
            bottom: 0;
        }

        /* Mobile Styles */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: white;
                border-radius: 15px;
                margin-top: 1rem;
                padding: 1rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(59, 130, 246, 0.1);
            }
            
            .nav-link-modern {
                padding: 0.75rem 1rem !important;
                margin: 0.25rem 0;
                border-radius: 10px;
            }
            
            .btn-navbar {
                width: 100%;
                margin: 0.5rem 0;
                text-align: center;
                display: inline-block;
            }
            
            /* Mobile Switcher */
            .nav-switcher {
                display: block;
                width: 100%;
                margin: 1rem 0;
            }
            
            .switcher-container {
                justify-content: center;
                padding: 0.75rem 1rem;
            }
            
            .switcher-toggle {
                flex-wrap: wrap;
                justify-content: center;
                gap: 0.75rem;
            }
        }

        /* Main Content */
        .main-content {
            min-height: calc(100vh - var(--navbar-height));
        }

        .main-content.no-navbar {
            min-height: 100vh;
        }

        /* Footer Styles */
        .footer-modern {
            background: linear-gradient(135deg, var(--dark-color) 0%, #374151 100%);
            color: white;
            padding: 3rem 0 2rem;
            margin-top: 4rem;
        }

        .footer-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            padding: 0.25rem 0;
        }

        .footer-links a:hover {
            color: var(--primary-light);
            transform: translateX(5px);
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 10px;
            margin: 0 0.5rem 0.5rem 0;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        /* Utility Classes */
        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        }

        .text-primary-custom {
            color: var(--primary-color) !important;
        }

        /* Loading Animation */
        .loading-spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(59, 130, 246, 0.2);
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* CSRF Error Notification */
        .csrf-error-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #ef4444;
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 10000;
            animation: slideInRight 0.3s ease-out;
            max-width: 400px;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
    
    @yield('styles')
    @stack('styles')
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JobMatch</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  @stack('styles')
</head>
<body class="{{ request()->is('login/*') || request()->is('register/*') ? 'no-navbar' : '' }}">
    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner"></div>
    </div>

    <!-- Navbar - Hidden on login/register pages -->
    @if (!request()->is('login/*') && !request()->is('register/*'))
    <nav class="navbar navbar-expand-lg navbar-modern fixed-top" id="mainNavbar">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand-modern" href="{{ url('/') }}">
                <div class="brand-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                JOBMATCH
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler navbar-toggler-modern" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
                    aria-label="Toggle navigation">
                <div class="navbar-toggler-icon-modern"></div>
            </button>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link-modern {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-modern" href="#jobs">
                            <i class="fas fa-search me-1"></i>Find Jobs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-modern" href="#Community">
                            <i class="fas fa-users me-1"></i>Community
                        </a>
                    </li>
                </ul>

                <!-- Right Side Navigation -->
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Navigation Switcher -->
                    <div class="nav-switcher me-3">
                        @if (request()->is('Company*'))
                            <div class="switcher-container">
                                <span class="switcher-label">You're in:</span>
                                <div class="switcher-toggle">
                                    <a href="{{ route('home') }}" class="switcher-option">
                                        <i class="fas fa-user me-1"></i>Job Seekers
                                    </a>
                                    <span class="switcher-active">
                                        <i class="fas fa-building me-1"></i>Companies
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="switcher-container">
                                <span class="switcher-label">You're in:</span>
                                <div class="switcher-toggle">
                                    <span class="switcher-active">
                                        <i class="fas fa-user me-1"></i>Job Seekers
                                    </span>
                                    <a href="{{ route('CompanyHome') }}" class="switcher-option">
                                        <i class="fas fa-building me-1"></i>Companies
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Authentication Links -->
                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link-modern dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <span class="d-none d-md-inline">{{ Auth::user()->name ?? 'User' }}</span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                                <li class="dropdown-header">
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar-small me-2">
                                            <i class="fas fa-user-circle text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ Auth::user()->name ?? 'User' }}</h6>
                                            <small class="text-muted">{{ Auth::user()->email ?? 'user@example.com' }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2 text-primary"></i>My Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-briefcase me-2 text-success"></i>My Applications</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2 text-info"></i>Settings</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-bell me-2 text-warning"></i>Notifications</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') ?? '#' }}" method="POST" class="d-inline w-100">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to logout?')">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Login Button based on current context -->
                        @if (request()->is('Company*'))
                            <li class="nav-item">
                                <a class="btn-navbar btn-navbar-solid" href="{{ route('login.company') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i>Company Login
                                </a>
                            </li>
                        @else
                            <li class="nav-item me-2">
                                <a class="btn-navbar btn-navbar-outline" href="{{ route('login.applicant') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i>Sign In
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn-navbar btn-navbar-solid" href="{{ route('register.applicant') }}">
                                    <i class="fas fa-user-plus me-1"></i>Sign Up
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @endif

    <!-- Main Content -->
    <main class="main-content {{ request()->is('login/*') || request()->is('register/*') ? 'no-navbar' : '' }}">
        @yield('content')
    </main>

    <!-- Footer - Hidden on login/register pages -->
    @if (!request()->is('login/*') && !request()->is('register/*'))
    <footer class="footer-modern">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand">
                        <i class="fas fa-briefcase me-2"></i>JOBMATCH
                    </div>
                    <p class="text-light opacity-75 mb-3">
                        Connecting talented professionals with amazing companies. 
                        Your career journey starts here.
                    </p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">For Job Seekers</h6>
                    <div class="footer-links">
                        <a href="#">Browse Jobs</a>
                        <a href="#">Career Advice</a>
                        <a href="#">Resume Builder</a>
                        <a href="#">Salary Guide</a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">For Companies</h6>
                    <div class="footer-links">
                        <a href="#">Post Jobs</a>
                        <a href="#">Find Candidates</a>
                        <a href="#">Recruitment Solutions</a>
                        <a href="#">Pricing</a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Community</h6>
                    <div class="footer-links">
                        <a href="#">Help Center</a>
                        <a href="#">Contact Support</a>
                        <a href="#">API Documentation</a>
                        <a href="#">Community</a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Company</h6>
                    <div class="footer-links">
                        <a href="#">About Us</a>
                        <a href="#">Careers</a>
                        <a href="#">Press</a>
                        <a href="#">Privacy Policy</a>
                    </div>
                </div>
            </div>
            
            <hr class="my-4" style="border-color: rgba(255, 255, 255, 0.2);">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-light opacity-75">
                        &copy; 2024 JobMatch. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="text-light opacity-75">
                        Made with <i class="fas fa-heart text-danger"></i> in Indonesia
                    </span>
                </div>
            </div>
        </div>
    </footer>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set up global CSRF token for all AJAX requests
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                const token = csrfToken.getAttribute('content');
                
                // Set up jQuery CSRF token (if jQuery is available)
                if (typeof $ !== 'undefined') {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    });
                }
                
                // Set up fetch defaults
                const originalFetch = window.fetch;
                window.fetch = function(url, options = {}) {
                    if (!options.headers) {
                        options.headers = {};
                    }
                    
                    // Add CSRF token to all POST, PUT, DELETE requests
                    if (options.method && ['POST', 'PUT', 'DELETE', 'PATCH'].includes(options.method.toUpperCase())) {
                        if (!options.headers['X-CSRF-TOKEN']) {
                            options.headers['X-CSRF-TOKEN'] = token;
                        }
                        if (!options.headers['X-Requested-With']) {
                            options.headers['X-Requested-With'] = 'XMLHttpRequest';
                        }
                    }
                    
                    return originalFetch(url, options);
                };
            }

            // Check for login pages and adjust body class
            const currentPath = window.location.pathname;
            if (currentPath.includes('/login/') || currentPath.includes('/register/')) {
                document.body.classList.add('no-navbar');
            }

            // Navbar scroll effect (only if navbar exists)
            const navbar = document.getElementById('mainNavbar');
            if (navbar) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }

            // Mobile menu toggle animation (only if navbar exists)
            const navbarToggler = document.querySelector('.navbar-toggler-modern');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            if (navbarToggler && navbarCollapse) {
                navbarCollapse.addEventListener('show.bs.collapse', function() {
                    navbarToggler.classList.add('collapsed');
                });
                
                navbarCollapse.addEventListener('hide.bs.collapse', function() {
                    navbarToggler.classList.remove('collapsed');
                });
            }

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        const offsetTop = target.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Loading spinner (for page transitions)
            const loadingSpinner = document.getElementById('loadingSpinner');
            
            // Show loading on form submissions
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function() {
                    // Don't show loading for logout forms
                    if (!this.action.includes('logout')) {
                        loadingSpinner.style.display = 'flex';
                    }
                });
            });

            // Hide loading spinner after page load
            window.addEventListener('load', function() {
                setTimeout(() => {
                    loadingSpinner.style.display = 'none';
                }, 500);
            });

            // Active navigation highlighting
            const currentLocation = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link-modern');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentLocation) {
                    link.classList.add('active');
                }
            });

            // Button hover effects
            document.querySelectorAll('.btn-navbar').forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px) scale(1.02)';
                });
                
                btn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Intersection Observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe elements for scroll animations
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'all 0.6s ease';
                observer.observe(el);
            });

            // Navigation switcher functionality
            document.querySelectorAll('.switcher-option').forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetUrl = this.getAttribute('href');
                    
                    // Show loading
                    loadingSpinner.style.display = 'flex';
                    
                    // Add smooth transition
                    document.body.style.opacity = '0.8';
                    
                    setTimeout(() => {
                        window.location.href = targetUrl;
                    }, 300);
                });
            });

            // CSRF Token refresh functionality
            function refreshCSRFToken() {
                fetch('/refresh-csrf-token', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.token) {
                        // Update meta tag
                        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                        if (csrfMeta) {
                            csrfMeta.setAttribute('content', data.token);
                        }
                        
                        // Update all CSRF input fields
                        document.querySelectorAll('input[name="_token"]').forEach(input => {
                            input.value = data.token;
                        });
                    }
                })
                .catch(error => {
                    console.error('Error refreshing CSRF token:', error);
                });
            }

            // Refresh CSRF token every 30 minutes
            setInterval(refreshCSRFToken, 30 * 60 * 1000);

            console.log('JobMatch layout initialized successfully with CSRF protection!');
        });

        // Global error handler for CSRF token mismatch
        window.addEventListener('unhandledrejection', function(event) {
            if (event.reason && event.reason.status === 419) {
                console.log('CSRF token mismatch detected, refreshing page...');
                
                // Show user-friendly message
                const notification = document.createElement('div');
                notification.className = 'csrf-error-notification';
                notification.innerHTML = `
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-shield-alt"></i>
                        <span>Security token expired. Refreshing page...</span>
                    </div>
                `;
                document.body.appendChild(notification);
                
                // Refresh page after showing message
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
                
                event.preventDefault();
            }
        });
    </script>

    @yield('scripts')
    @stack('scripts')
</body>
</html>