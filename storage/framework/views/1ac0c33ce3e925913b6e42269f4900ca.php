<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - JobMatch</title>
    <meta name="description" content="<?php echo $__env->yieldContent('description', 'Your personal job matching dashboard'); ?>">
    
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
        }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Enhanced Dashboard Navbar -->
    <nav class="navbar navbar-expand-lg dashboard-navbar fixed-top" id="dashboardNavbar">
        <div class="container-fluid px-4">
            <!-- Enhanced Brand Logo -->
            <a class="dashboard-brand" href="<?php echo e(route('company.dashboard')); ?>">
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
                        <a href="<?php echo e(route('chat_company')); ?>" class="nav-link">
                            <i class="fas fa-comments"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('company.job.create')); ?>" class="nav-link btn-post-job <?php echo e(request()->routeIs('company.job.create') ? 'active' : ''); ?>">
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
                                <?php echo e(substr(Auth::user()->name ?? 'C', 0, 1)); ?>

                            </div>
                            <div class="user-info d-none d-md-block">
                                <h6><?php echo e(Auth::user()->name ?? 'Company'); ?></h6>
                                <small><?php echo e(ucfirst(Auth::user()->role ?? 'Company')); ?></small>
                            </div>
                            <i class="fas fa-chevron-down text-muted ms-2"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-3">
                                        <?php echo e(substr(Auth::user()->name ?? 'C', 0, 1)); ?>

                                    </div>
                                    <div>
                                        <h6 class="mb-0"><?php echo e(Auth::user()->name ?? 'Company'); ?></h6>
                                        <small class="text-muted"><?php echo e(Auth::user()->email ?? 'company@example.com'); ?></small>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#">
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
                                <a class="dropdown-item" href="<?php echo e(url('/')); ?>">
                                    <i class="fas fa-home"></i>Back to Main Site
                                </a>
                            </li>
                            <li>
                                <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline w-100">
                                    <?php echo csrf_field(); ?>
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
            <?php if(!request()->routeIs('company.dashboard')): ?>
            <nav class="dashboard-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('company.dashboard')); ?>">
                            <i class="fas fa-home me-1"></i>Dashboard
                        </a>
                    </li>
                    <?php echo $__env->yieldContent('breadcrumb'); ?>
                </ol>
            </nav>
            <?php endif; ?>

            <!-- Page Content -->
            <?php echo $__env->yieldContent('content'); ?>
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
            let lastScrollTop = 0;
            
            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
                
                lastScrollTop = scrollTop;
            });

            // Enhanced search functionality
            const searchInput = document.querySelector('.dashboard-search input');
            if (searchInput) {
                let searchTimeout;
                
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    const searchTerm = this.value.trim();
                    
                    if (searchTerm.length > 2) {
                        searchTimeout = setTimeout(() => {
                            // Implement real-time search
                            console.log('Searching for:', searchTerm);
                        }, 300);
                    }
                });

                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const searchTerm = this.value.trim();
                        if (searchTerm) {
                            // Redirect to search results
                            window.location.href = `/company/search?q=${encodeURIComponent(searchTerm)}`;
                        }
                    }
                });
            }

            // Auto-hide notifications
            setTimeout(() => {
                const notifications = document.querySelectorAll('.notification-item');
                notifications.forEach(notification => {
                    notification.addEventListener('click', function() {
                        this.style.opacity = '0.5';
                    });
                });
            }, 1000);

            // Enhanced dropdown behavior
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('[data-bs-toggle="dropdown"]');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                toggle.addEventListener('click', function() {
                    // Add animation class
                    menu.style.animation = 'fadeInUp 0.3s ease';
                });
            });

            console.log('JobMatch Company Dashboard initialized successfully!');
        });

        // Utility functions
        function showToast(message, type = 'success') {
            // Implement toast notification system
            console.log(`Toast: ${message} (${type})`);
        }

        function updateNotificationCount(count) {
            const badge = document.querySelector('.notification-badge');
            if (badge) {
                badge.textContent = count;
                badge.style.display = count > 0 ? 'flex' : 'none';
                
                if (count > 0) {
                    badge.style.animation = 'pulse 2s infinite';
                }
            }
        }

        // Add CSS animation keyframes
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

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\REDMI\Documents\jobmatch_finaly\resources\views/layouts/dashboardcompany.blade.php ENDPATH**/ ?>