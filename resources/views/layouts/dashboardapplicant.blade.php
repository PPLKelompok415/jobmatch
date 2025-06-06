<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - JobMatch</title>
    <meta name="description" content="@yield('description', 'Your personal job matching dashboard')">
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
    
    <!-- Custom Dashboard Styles -->
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-dark: #1e40af;
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
            padding-top: var(--navbar-height);
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
            background: linear-gradient(135deg, var(--primary-color) 0%, #8b5cf6 100%);
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

        /* Breadcrumb */
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

        /* Quick Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, #8b5cf6 100%);
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
    </style>
    
    @stack('styles')
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
                <a href="#" class="dashboard-nav-link">
                    <i class="fas fa-file-alt"></i>
                    <span>My Applications</span>
                </a>
                <a href="{{ route('chat') }}" class="dashboard-nav-link">
                    <i class="fas fa-comments"></i>
                    <span>Messages</span>
                </a>
                <a href="{{ route('bookmark') }}" class="dashboard-nav-link">
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
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
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
                                    {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ Auth::user()->name ?? 'User' }}</h6>
                                    <small class="text-muted">{{ Auth::user()->email ?? 'user@example.com' }}</small>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i>My Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-file-alt"></i>My Resume</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i>Account Settings</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-question-circle"></i>Help & Support</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('/') }}"><i class="fas fa-home"></i>Back to Main Site</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to logout?')">
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

            <!-- Page Content -->
            @yield('content')
        </div>
    </main>

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

            // Search functionality
            const searchInput = document.querySelector('.dashboard-search input');
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        const searchTerm = this.value.trim();
                        if (searchTerm) {
                            // Implement search functionality here
                            console.log('Searching for:', searchTerm);
                            // You can redirect to a search results page or filter current content
                        }
                    }
                });
            }

            console.log('JobMatch Applicant Dashboard initialized successfully!');
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
            
            if (!navLinks.contains(e.target) && !toggleButton.contains(e.target)) {
                navLinks.classList.remove('show');
            }
        });

        // Notification handling
        function markNotificationAsRead(notificationId) {
            // Implement notification read functionality
            console.log('Marking notification as read:', notificationId);
        }

        // Real-time notifications (you can integrate with WebSocket or polling)
        function updateNotificationCount(count) {
            const badge = document.querySelector('.notification-badge');
            if (badge) {
                badge.textContent = count;
                badge.style.display = count > 0 ? 'flex' : 'none';
            }
        }
    </script>

    @stack('scripts')
</body>
</html>