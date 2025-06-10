<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>JobMatch - <?php echo $__env->yieldContent('title', 'Find Your Perfect Match'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('description', 'Connect talented professionals with amazing companies. JobMatch is the premier platform for recruitment and job searching in Indonesia.'); ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --navbar-height: 70px;
        }
        
        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            padding-top: var(--navbar-height);
        }
        
        body.no-navbar {
            padding-top: 0;
        }
        
        /* Navbar Styling */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            height: var(--navbar-height);
            padding: 0.5rem 0;
        }
        
        .navbar-custom.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }
        
        /* Brand Styling */
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: #0d6efd !important;
            text-decoration: none;
        }
        
        .brand-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 10px;
            font-size: 1rem;
            box-shadow: 0 3px 10px rgba(13, 110, 253, 0.3);
        }
        
        /* Navigation Links */
        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 0 2px;
        }
        
        .navbar-nav .nav-link:hover {
            background: rgba(13, 110, 253, 0.1);
            color: #0d6efd !important;
        }
        
        .navbar-nav .nav-link.active {
            background: rgba(13, 110, 253, 0.15);
            color: #0d6efd !important;
            font-weight: 600;
        }
        
        /* Switcher Styling */
        .nav-switcher {
            background: rgba(13, 110, 253, 0.1);
            border: 1px solid rgba(13, 110, 253, 0.2);
            border-radius: 25px;
            padding: 6px 12px;
            font-size: 0.875rem;
        }
        
        .switcher-active {
            background: #0d6efd;
            color: white !important;
            border-radius: 18px;
            padding: 4px 12px;
            font-weight: 500;
            text-decoration: none;
        }
        
        .switcher-option {
            color: #6c757d;
            text-decoration: none;
            padding: 4px 12px;
            border-radius: 18px;
            transition: all 0.2s;
        }
        
        .switcher-option:hover {
            background: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }
        
        /* Button Styling */
        .btn-custom-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        
        .btn-custom-primary:hover {
            background: linear-gradient(135deg, #0a58ca 0%, #084298 100%);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4);
        }
        
        .btn-outline-custom {
            border: 2px solid #0d6efd;
            color: #0d6efd;
            font-weight: 600;
            padding: 6px 20px;
            border-radius: 25px;
            background: transparent;
            transition: all 0.3s ease;
        }
        
        .btn-outline-custom:hover {
            background: #0d6efd;
            color: white;
            transform: translateY(-1px);
        }
        
        .btn-dashboard {
            background: linear-gradient(135deg, #198754 0%, #146c43 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        
        .btn-dashboard:hover {
            background: linear-gradient(135deg, #146c43 0%, #0f5132 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 135, 84, 0.4);
        }
        
        /* Dropdown Styling */
        .dropdown-menu-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            padding: 1rem;
            min-width: 280px;
        }
        
        .dropdown-header-custom {
            background: rgba(13, 110, 253, 0.05);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .dropdown-item-custom {
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.2s ease;
            font-weight: 500;
        }
        
        .dropdown-item-custom:hover {
            background: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }
        
        /* Mobile Responsive */
        @media (max-width: 991px) {
            .navbar-nav {
                padding-top: 1rem;
            }
            
            .nav-switcher {
                margin: 1rem 0;
                justify-content: center;
            }
            
            .navbar-nav .nav-link {
                text-align: center;
                margin: 2px 0;
            }
        }
        
        /* Loading and Modal */
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
        
        .access-denied-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            z-index: 10001;
            max-width: 450px;
            animation: modalSlideIn 0.3s ease-out;
        }
        
        .modal-backdrop-custom {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10000;
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes modalSlideIn {
            from {
                transform: translate(-50%, -50%) scale(0.7);
                opacity: 0;
            }
            to {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* Specific styles for profile pic in navbar */
        .navbar-profile-pic {
            width: 40px; 
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            margin-left: 10px; /* Adjust spacing if needed */
        }
    </style>
    
    <?php echo $__env->yieldContent('styles'); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="<?php echo e(request()->is('login/*') || request()->is('register/*') ? 'no-navbar' : ''); ?>">
    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Navbar - Hidden on login/register pages -->
    <?php if(!request()->is('login/*') && !request()->is('register/*')): ?>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top" id="mainNavbar">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center" href="<?php echo e(url('/')); ?>">
                <div class="brand-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                JOBMATCH
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <i class="fas fa-bars text-primary fs-5"></i>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Left Navigation -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>" href="<?php echo e(url('/')); ?>">
                            <i class="fas fa-home me-2"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php
                            $communityLink = '#Community'; // Default placeholder
                            $communityOnClick = '';
                            
                            if (Auth::check()) {
                                // If logged in, direct to community based on role
                                $communityLink = route('community.index'); // Always go to community.index if logged in
                            } else {
                                // If not logged in, direct to login
                                $communityLink = route('login.applicant'); // Default to applicant login
                                if (request()->is('Company*')) {
                                    $communityLink = route('login.company');
                                }
                                $communityOnClick = "handleCommunityClick(event, '{$communityLink}')";
                            }
                        ?>
                        <a class="nav-link <?php echo e(request()->is('*community*') ? 'active' : ''); ?>"
                           href="<?php echo e($communityLink); ?>"
                           <?php if(!Auth::check()): ?> onclick="<?php echo e($communityOnClick); ?>" <?php endif; ?>>
                            <i class="fas fa-users me-2"></i>Community
                        </a>
                    </li>
                </ul>

                <!-- Right Navigation -->
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <!-- Navigation Switcher -->
                    <div class="nav-switcher d-none d-lg-flex align-items-center gap-2">
                        <small class="text-muted fw-medium">You're in:</small>
                        <?php if(request()->is('Company*')): ?>
                            <div class="d-flex align-items-center gap-1">
                                <a href="<?php echo e(route('home')); ?>" class="switcher-option" onclick="handleSwitcherClick(event, '<?php echo e(route('home')); ?>')">
                                    <i class="fas fa-user me-1"></i>Job Seekers
                                </a>
                                <span class="switcher-active">
                                    <i class="fas fa-building me-1"></i>Companies
                                </span>
                            </div>
                        <?php else: ?>
                            <div class="d-flex align-items-center gap-1">
                                <span class="switcher-active">
                                    <i class="fas fa-user me-1"></i>Job Seekers
                                </span>
                                <a href="<?php echo e(route('CompanyHome')); ?>" class="switcher-option" onclick="handleSwitcherClick(event, '<?php echo e(route('CompanyHome')); ?>')">
                                    <i class="fas fa-building me-1"></i>Companies
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Authentication Section -->
                    <?php if(auth()->guard()->check()): ?>
                        <!-- Dashboard Button -->
                        <?php if(Auth::user()->role === 'company'): ?>
                            <a href="<?php echo e(route('company.dashboard')); ?>" class="btn btn-dashboard">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        <?php elseif(Auth::user()->role === 'applicant'): ?>
                            <a href="<?php echo e(route('applicant.dashboard')); ?>" class="btn btn-dashboard">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        <?php elseif(Auth::user()->role === 'admin'): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-warning text-white fw-semibold" style="border-radius: 25px;">
                                <i class="fas fa-shield-alt me-2"></i>Admin Panel
                            </a>
                        <?php endif; ?>

                        
                        
                        <?php echo $__env->yieldContent('right_navbar_logo'); ?>

                        
                        <?php if(!View::hasSection('right_navbar_logo')): ?>
                            <div class="dropdown">
                                <button class="btn btn-outline-custom dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                                    
                                    <?php
                                        $user = Auth::user();
                                        $applicant = $user->applicant ?? null;
                                        $profilePhoto = $applicant && $applicant->photo ? asset('storage/' . $applicant->photo) : asset('images/default_profile.png');
                                    ?>
                                    <img src="<?php echo e($profilePhoto); ?>?v=<?php echo e($applicant->updated_at ? $applicant->updated_at->timestamp : now()->timestamp); ?>" alt="Profile" class="navbar-profile-pic me-2">
                                    <span class="d-none d-md-inline"><?php echo e(Auth::user()->name); ?></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
                                    <!-- User Info Header -->
                                    <li class="dropdown-header-custom">
                                        <div class="d-flex align-items-center">
                                            
                                            <img src="<?php echo e($profilePhoto); ?>?v=<?php echo e($applicant->updated_at ? $applicant->updated_at->timestamp : now()->timestamp); ?>" alt="Profile" class="navbar-profile-pic me-3" style="width: 50px; height: 50px;">
                                            <div>
                                                <h6 class="mb-0 fw-bold"><?php echo e(Auth::user()->name); ?></h6>
                                                <small class="text-muted"><?php echo e(Auth::user()->email); ?></small>
                                                <br><span class="badge bg-primary mt-1"><?php echo e(ucfirst(Auth::user()->role)); ?></span>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <li><hr class="dropdown-divider"></li>
                                    
                                    <!-- Menu Items -->
                                    <li>
                                        <a class="dropdown-item dropdown-item-custom" href="<?php echo e(route('profile.show')); ?>">
                                            <i class="fas fa-user me-3 text-primary"></i>My Profile
                                        </a>
                                    </li>
                                    
                                    <?php if(Auth::user()->role === 'applicant'): ?>
                                        <li>
                                            <a class="dropdown-item dropdown-item-custom" href="#">
                                                <i class="fas fa-briefcase me-3 text-success"></i>My Applications
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item dropdown-item-custom" href="<?php echo e(route('bookmark')); ?>">
                                                <i class="fas fa-bookmark me-3 text-warning"></i>Bookmarks
                                            </a>
                                        </li>
                                    <?php elseif(Auth::user()->role === 'company'): ?>
                                        <li>
                                            <a class="dropdown-item dropdown-item-custom" href="#">
                                                <i class="fas fa-building me-3 text-success"></i>Company Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item dropdown-item-custom" href="#">
                                                <i class="fas fa-users me-3 text-info"></i>Job Applications
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    
                                    <li>
                                        <a class="dropdown-item dropdown-item-custom" href="#">
                                            <i class="fas fa-cog me-3 text-info"></i>Settings
                                        </a>
                                    </li>
                                    
                                    <li><hr class="dropdown-divider"></li>
                                    
                                    <li>
                                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline w-100">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="dropdown-item dropdown-item-custom text-danger w-100 text-start border-0 bg-transparent" onclick="return confirm('Are you sure you want to logout?')">
                                                <i class="fas fa-sign-out-alt me-3"></i>Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- Login/Register Buttons -->
                        <div class="d-flex gap-2 flex-wrap">
                            <?php if(request()->is('Company*')): ?>
                                <a href="<?php echo e(route('login.company')); ?>" class="btn btn-outline-custom">
                                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                                </a>
                                <a href="<?php echo e(route('register.company')); ?>" class="btn btn-custom-primary">
                                    <i class="fas fa-user-plus me-2"></i>Sign Up
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('login.applicant')); ?>" class="btn btn-outline-custom">
                                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                                </a>
                                <a href="<?php echo e(route('register.applicant')); ?>" class="btn btn-custom-primary">
                                    <i class="fas fa-user-plus me-2"></i>Sign Up
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="min-vh-100" style="<?php echo e(request()->is('login/*') || request()->is('register/*') ? 'padding-top: 0;' : ''); ?>">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer - Hidden on login/register pages -->
    <?php if(!request()->is('login/*') && !request()->is('register/*')): ?>
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-briefcase me-2"></i>JOBMATCH
                    </h5>
                    <p class="text-white-50 mb-3">
                        Connecting talented professionals with amazing companies.
                        Your career journey starts here.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center"
                           style="width: 40px; height: 40px;">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center"
                           style="width: 40px; height: 40px;">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center"
                           style="width: 40px; height: 40px;">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center"
                           style="width: 40px; height: 40px;">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">For Job Seekers</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">Browse Jobs</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Career Advice</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Resume Builder</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Salary Guide</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">For Companies</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">Post Jobs</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Find Candidates</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Solutions</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Pricing</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Support</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">Help Center</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Contact Us</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Privacy Policy</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Terms</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Company</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">About Us</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Careers</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Press</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Blog</a></li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4 border-secondary">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-white-50">
                        &copy; 2024 JobMatch. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="text-white-50">
                        Made with <i class="fas fa-heart text-danger"></i> in Indonesia
                    </span>
                </div>
            </div>
        </div>
    </footer>
    <?php endif; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // CSRF Token Setup
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                const token = csrfToken.getAttribute('content');
                
                const originalFetch = window.fetch;
                window.fetch = function(url, options = {}) {
                    if (!options.headers) {
                        options.headers = {};
                    }
                    
                    if (options.method && ['POST', 'PUT', 'DELETE', 'PATCH'].includes(options.method.toUpperCase())) {
                        options.headers['X-CSRF-TOKEN'] = token;
                        options.headers['X-Requested-With'] = 'XMLHttpRequest';
                    }
                    
                    return originalFetch(url, options);
                };
            }

            // Navbar scroll effect
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

            // Loading spinner control
            const loadingSpinner = document.getElementById('loadingSpinner');
            
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function() {
                    if (!this.action.includes('logout')) {
                        loadingSpinner.style.display = 'flex';
                    }
                });
            });

            window.addEventListener('load', function() {
                setTimeout(() => loadingSpinner.style.display = 'none', 500);
            });

            // Role-based access control
            <?php if(auth()->guard()->check()): ?>
                const userRole = '<?php echo e(Auth::user()->role); ?>';
                const currentPath = window.location.pathname;
                
                if (userRole === 'applicant' && currentPath.includes('/company/dashboard')) {
                    showAccessDenied(
                        'Access Denied',
                        'You are not authorized to access company dashboard. Please login with a company account.',
                        'Redirecting to Applicant Dashboard...',
                        '<?php echo e(route('applicant.dashboard')); ?>'
                    );
                }
                
                if (userRole === 'company' && currentPath.includes('/applicant/dashboard')) {
                    showAccessDenied(
                        'Access Denied',
                        'You are not authorized to access applicant dashboard. Please login with an applicant account.',
                        'Redirecting to Company Dashboard...',
                        '<?php echo e(route('company.dashboard')); ?>'
                    );
                }
                
                if (userRole !== 'admin' && currentPath.includes('/admin/dashboard')) {
                    showAccessDenied(
                        'Admin Access Required',
                        'You need administrator privileges to access this area.',
                        'Redirecting to your Dashboard...',
                        userRole === 'company' ? '<?php echo e(route('company.dashboard')); ?>' : '<?php echo e(route('applicant.dashboard')); ?>'
                    );
                }
            <?php endif; ?>

            console.log('JobMatch layout initialized successfully!');
        });

        // Community link handler
        function handleCommunityClick(event, loginUrl) {
            event.preventDefault();
            
            const loadingSpinner = document.getElementById('loadingSpinner');
            loadingSpinner.style.display = 'flex';
            
            showInfoModal(
                'Login Required',
                'Please login to access the Community features. You will be redirected to the login page.',
                'Redirecting to Login...'
            );
            
            setTimeout(() => window.location.href = loginUrl, 2000);
        }

        // Switcher handler
        function handleSwitcherClick(event, targetUrl) {
            event.preventDefault();
            
            const loadingSpinner = document.getElementById('loadingSpinner');
            loadingSpinner.style.display = 'flex';
            
            setTimeout(() => window.location.href = targetUrl, 300);
        }

        // Access denied modal
        function showAccessDenied(title, message, redirectMsg, redirectUrl) {
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop-custom';
            
            const modal = document.createElement('div');
            modal.className = 'access-denied-modal p-4';
            modal.innerHTML = `
                <div class="text-center">
                    <div class="text-danger mb-4">
                        <i class="fas fa-shield-alt" style="font-size: 4rem;"></i>
                    </div>
                    <h3 class="text-danger mb-3 fw-bold">${title}</h3>
                    <p class="text-muted mb-4">${message}</p>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3 mb-3">
                        <small class="text-warning fw-medium">
                            <i class="fas fa-clock me-2"></i>${redirectMsg}
                        </small>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-danger progress-bar-animated" role="progressbar" style="width: 100%"></div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(backdrop);
            document.body.appendChild(modal);
            
            setTimeout(() => window.location.href = redirectUrl, 3000); // Redirect after 3 seconds
        }

        // Info modal (for login required, etc.)
        function showInfoModal(title, message, redirectMsg = null, redirectUrl = null) {
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop-custom';
            
            const modal = document.createElement('div');
            modal.className = 'access-denied-modal p-4'; // Reusing style for consistency
            modal.innerHTML = `
                <div class="text-center">
                    <div class="text-primary mb-4">
                        <i class="fas fa-info-circle" style="font-size: 4rem;"></i>
                    </div>
                    <h3 class="text-primary mb-3 fw-bold">${title}</h3>
                    <p class="text-muted mb-4">${message}</p>
                    ${redirectMsg ? `
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 mb-3">
                            <small class="text-primary fw-medium">
                                <i class="fas fa-clock me-2"></i>${redirectMsg}
                            </small>
                        </div>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar bg-primary progress-bar-animated" role="progressbar" style="width: 100%"></div>
                        </div>
                    ` : ''}
                </div>
            `;
            
            document.body.appendChild(backdrop);
            document.body.appendChild(modal);

            if (redirectUrl) {
                setTimeout(() => window.location.href = redirectUrl, 2000);
            }
        }
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\REDMI\Documents\jobmatch_finaly\resources\views/layouts/app.blade.php ENDPATH**/ ?>