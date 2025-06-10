@extends('layouts.app')

@section('content')
<div class="login-wrapper position-relative min-vh-100">
    <!-- Animated Background dengan Bootstrap utilities -->
    <div class="position-fixed top-0 start-0 w-100 h-100" style="z-index: -1; background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 50%, #3730a3 100%);">
        <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden">
            <!-- Floating orbs dengan Bootstrap positioning -->
            <div class="position-absolute rounded-circle" style="width: 400px; height: 400px; top: -200px; left: -200px; background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.05)); backdrop-filter: blur(2px); animation: float 20s infinite ease-in-out;"></div>
            <div class="position-absolute rounded-circle" style="width: 300px; height: 300px; top: 50%; right: -150px; background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.05)); backdrop-filter: blur(2px); animation: float 20s infinite ease-in-out -7s;"></div>
            <div class="position-absolute rounded-circle" style="width: 200px; height: 200px; bottom: -100px; left: 20%; background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.05)); backdrop-filter: blur(2px); animation: float 20s infinite ease-in-out -14s;"></div>
            <div class="position-absolute rounded-circle" style="width: 150px; height: 150px; top: 20%; left: 60%; background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.05)); backdrop-filter: blur(2px); animation: float 20s infinite ease-in-out -10s;"></div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row min-vh-100 g-0">
            <!-- Left Panel - Brand Showcase dengan Bootstrap utilities -->
            <div class="col-lg-7 d-none d-lg-flex">
                <div class="d-flex flex-column h-100 p-4 text-white position-relative" style="z-index: 2;">
                    <!-- Navigation dengan Bootstrap spacing -->
                    <nav class="d-flex justify-content-start align-items-center mb-5">
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3 border border-white border-opacity-25" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px);">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div>
                                <h3 class="mb-0">JobMatch</h3>
                                <span class="opacity-75">for Companies</span>
                            </div>
                        </div>
                    </nav>
                    
                    <!-- Main Content dengan Bootstrap flex utilities -->
                    <div class="flex-grow-1 d-flex flex-column">
                        <div class="mb-5">
                            <!-- Hero badge dengan Bootstrap badge utilities -->
                            <div class="d-inline-flex align-items-center mb-4 px-3 py-2 rounded-pill border border-white border-opacity-25" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px);">
                                <i class="fas fa-crown me-2"></i>
                                <span class="fw-semibold small">Premium Recruitment Platform</span>
                            </div>
                            
                            <!-- Hero title dengan Bootstrap typography -->
                            <h1 class="display-2 fw-bold lh-1 mb-4" style="letter-spacing: -0.02em;">
                                Transform Your<br>
                                <span class="text-warning">Hiring Process</span>
                            </h1>
                            
                            <p class="fs-5 opacity-75">
                                Join 2,500+ companies using AI-powered matching to find exceptional talent faster than ever before.
                            </p>
                        </div>
                        
                        <!-- Interactive Features dengan Bootstrap cards -->
                        <div class="mb-5">
                            <!-- Feature Card 1 -->
                            <div class="d-flex align-items-center gap-4 p-4 mb-3 rounded-3 border border-white border-opacity-25 feature-card active" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); cursor: pointer; transition: all 0.3s ease;">
                                <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-3" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.15);">
                                    <i class="fas fa-magic"></i>
                                </div>
                                <div>
                                    <h4 class="mb-2">AI-Powered Matching</h4>
                                    <p class="mb-2 opacity-75">Advanced algorithms analyze 200+ data points to find perfect candidates</p>
                                    <div class="d-flex align-items-baseline">
                                        <span class="fs-3 fw-bold text-warning">95%</span>
                                        <span class="ms-2 small opacity-75">Match Accuracy</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Feature Card 2 -->
                            <div class="d-flex align-items-center gap-4 p-4 mb-3 rounded-3 border border-white border-opacity-25 feature-card" style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(10px); cursor: pointer; transition: all 0.3s ease;">
                                <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-3" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.15);">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <div>
                                    <h4 class="mb-2">Lightning Fast Hiring</h4>
                                    <p class="mb-2 opacity-75">Reduce time-to-hire from weeks to days with automated screening</p>
                                    <div class="d-flex align-items-baseline">
                                        <span class="fs-3 fw-bold text-warning">3x</span>
                                        <span class="ms-2 small opacity-75">Faster Hiring</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Feature Card 3 -->
                            <div class="d-flex align-items-center gap-4 p-4 mb-3 rounded-3 border border-white border-opacity-25 feature-card" style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(10px); cursor: pointer; transition: all 0.3s ease;">
                                <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-3" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.15);">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div>
                                    <h4 class="mb-2">Advanced Analytics</h4>
                                    <p class="mb-2 opacity-75">Real-time insights and predictive analytics for better decisions</p>
                                    <div class="d-flex align-items-baseline">
                                        <span class="fs-3 fw-bold text-warning">360°</span>
                                        <span class="ms-2 small opacity-75">View Analytics</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Panel - Login Form dengan Bootstrap components -->
            <div class="col-lg-5 d-flex align-items-center justify-content-center">
                <div class="w-100 px-4" style="max-width: 500px;">
                    <!-- Back to Site Button dengan Bootstrap button -->
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('home') }}" class="btn btn-light btn-sm d-flex align-items-center gap-2 text-decoration-none border border-primary text-primary" 
                           style="transition: all 0.3s ease;"
                           onmouseenter="this.classList.add('shadow-lg', 'btn-primary', 'text-white'); this.classList.remove('btn-light', 'text-primary'); this.style.transform='translateX(-5px)'"
                           onmouseleave="this.classList.remove('shadow-lg', 'btn-primary', 'text-white'); this.classList.add('btn-light', 'text-primary'); this.style.transform='translateX(0)'">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back to Site</span>
                        </a>
                    </div>
                    
                    <!-- Mobile Header dengan Bootstrap display utilities -->
                    <div class="d-lg-none text-center mb-4 py-4">
                        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-3 bg-primary text-white" style="width: 60px; height: 60px;">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h2 class="mb-2">Company Login</h2>
                        <p class="text-muted">Access your recruitment dashboard</p>
                    </div>
                    
                    <!-- Error/Success Notifications -->
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <div>
                                    <strong>Login Failed!</strong><br>
                                    {{ session('error') }}
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2"></i>
                                <div>
                                    <strong>Success!</strong><br>
                                    {{ session('success') }}
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-exclamation-triangle me-2 mt-1"></i>
                                <div>
                                    <strong>Please check the following errors:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <!-- Login Card dengan Bootstrap card -->
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden position-relative">
                        <!-- Top gradient bar dengan Bootstrap utilities -->
                        <div class="position-absolute top-0 start-0 end-0 bg-gradient" style="height: 4px; background: linear-gradient(90deg, #4f46e5 0%, #06b6d4 100%);"></div>
                        
                        <!-- Card Header dengan Bootstrap spacing -->
                        <div class="card-header bg-transparent border-0 pt-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="d-none d-lg-flex align-items-center justify-content-center rounded-3 text-white" style="width: 50px; height: 50px; background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div>
                                    <h2 class="mb-1">Welcome Back</h2>
                                    <p class="text-muted mb-0">Sign in to your company dashboard</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Login Form dengan Bootstrap form components -->
                        <div class="card-body">
                            <form action="{{ route('company.login.post') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                
                                <!-- Hidden field to identify this as company login -->
                                <input type="hidden" name="user_type" value="company">
                                
                                <!-- Email Field dengan Bootstrap input group -->
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-semibold">Company Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" 
                                               id="email" 
                                               name="email" 
                                               class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                               placeholder="Enter your company email" 
                                               value="{{ old('email') }}"
                                               required 
                                               autocomplete="email">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback"></div>
                                    @enderror
                                </div>
                                
                                <!-- Password Field dengan Bootstrap input group -->
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password" 
                                               id="password" 
                                               name="password" 
                                               class="form-control border-start-0 @error('password') is-invalid @enderror" 
                                               placeholder="Enter your password" 
                                               required 
                                               autocomplete="current-password">
                                        <button type="button" class="btn btn-light border border-start-0 password-reveal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback"></div>
                                    @enderror
                                </div>
                                
                                <!-- Form Options dengan Bootstrap flex utilities -->
                                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">Keep me signed in</label>
                                    </div>
                                    <a href="#" class="text-decoration-none fw-semibold text-primary">Forgot password?</a>
                                </div>
                                
                                <!-- Submit Button dengan Bootstrap button -->
                                <button type="submit" class="btn btn-primary w-100 py-3 position-relative overflow-hidden mb-4 fw-semibold fs-6 submit-btn" style="background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); border: none;">
                                    <span class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-sign-in-alt me-2"></i>
                                        Access Dashboard
                                    </span>
                                    <div class="position-absolute top-50 start-50 translate-middle opacity-0">
                                        <div class="spinner-border spinner-border-sm text-light" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </button>
                                
                                <!-- Enhanced Role Restriction Notice -->
                                <div class="d-flex align-items-start gap-3 bg-danger bg-opacity-10 p-3 rounded-3 border border-danger border-opacity-25 mb-4">
                                    <div class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block mb-1 text-danger">🏢 Companies Only</strong>
                                        <p class="small text-muted mb-2">This login portal is exclusively for companies and employers. Job seeker accounts are restricted from accessing this area.</p>
                                        <p class="small text-muted mb-0">
                                            <strong>Looking for a job?</strong> 
                                            <a href="{{ route('login.applicant') }}" class="text-success text-decoration-none fw-semibold">Use Job Seeker Login Portal →</a>
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Enterprise Security Notice dengan Bootstrap alerts -->
                                <div class="d-flex align-items-start gap-3 bg-primary bg-opacity-10 p-3 rounded-3 border border-primary border-opacity-25 mb-4">
                                    <div class="text-primary">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block mb-1">Enterprise Security Enabled</strong>
                                        <p class="small text-muted mb-0">Your account is protected with bank-level encryption and monitoring</p>
                                    </div>
                                </div>
                                
                                <!-- Social Login dengan Bootstrap grid -->
                                <div class="text-center mb-4">
                                    <div class="position-relative">
                                        <hr>
                                        <span class="position-absolute top-50 start-50 translate-middle px-3 bg-white text-muted small">Or continue with</span>
                                    </div>
                                </div>
                                
                                <div class="row g-2 mb-4">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                                            <i class="fab fa-google"></i>
                                            <span class="small">Google</span>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-info w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                                            <i class="fab fa-linkedin"></i>
                                            <span class="small">LinkedIn</span>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Register Section dengan Bootstrap utilities -->
                                <div class="text-center p-3 bg-light rounded-3 mb-4 border">
                                    <p class="text-muted mb-2">Don't have a company account?</p>
                                    <a href="{{ route('register.company') }}" class="text-decoration-none fw-semibold text-primary">
                                        Create Company Account
                                        <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                                
                                <!-- Alternative Actions dengan Bootstrap grid -->
                                <div class="position-relative text-center my-4">
                                    <hr>
                                    <span class="position-absolute top-50 start-50 translate-middle px-3 bg-white text-muted small">Other options</span>
                                </div>
                                
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <a href="{{ route('login.applicant') }}" class="btn btn-outline-secondary text-start d-flex align-items-center gap-3 p-3 w-100">
                                            <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-light rounded-2" style="width: 40px; height: 40px;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div>
                                                <span class="d-block fw-semibold">Job Seeker Login</span>
                                                <span class="small text-muted">Looking for jobs instead?</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-5">
                                        <button type="button" class="btn btn-outline-secondary text-start d-flex align-items-center gap-3 p-3 w-100" onclick="showSupportModal()">
                                            <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-light rounded-2" style="width: 40px; height: 40px;">
                                                <i class="fas fa-headset"></i>
                                            </div>
                                            <div>
                                                <span class="d-block fw-semibold">Get Support</span>
                                                <span class="small text-muted">Need help signing in?</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Support Modal dengan Bootstrap modal -->
<div class="modal fade" id="supportModal" tabindex="-1" aria-labelledby="supportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="supportModalLabel">Get Enterprise Support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush">
                    <a href="mailto:enterprise@jobmatch.com" class="list-group-item list-group-item-action d-flex align-items-center gap-3 p-3">
                        <i class="fas fa-envelope text-primary fs-4"></i>
                        <div>
                            <strong class="d-block">Enterprise Support</strong>
                            <p class="mb-0 text-muted">enterprise@jobmatch.com</p>
                        </div>
                    </a>
                    <a href="tel:+6221-1234-9999" class="list-group-item list-group-item-action d-flex align-items-center gap-3 p-3">
                        <i class="fas fa-phone text-success fs-4"></i>
                        <div>
                            <strong class="d-block">Priority Hotline</strong>
                            <p class="mb-0 text-muted">+62-21-1234-9999</p>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center gap-3 p-3">
                        <i class="fas fa-comments text-warning fs-4"></i>
                        <div>
                            <strong class="d-block">Dedicated Chat</strong>
                            <p class="mb-0 text-muted">24/7 Enterprise Support</p>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center gap-3 p-3">
                        <i class="fas fa-calendar text-info fs-4"></i>
                        <div>
                            <strong class="d-block">Schedule Demo</strong>
                            <p class="mb-0 text-muted">Book a consultation</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(50px, -50px) rotate(90deg); }
        50% { transform: translate(-30px, 40px) rotate(180deg); }
        75% { transform: translate(40px, 30px) rotate(270deg); }
    }

    .feature-card:hover {
        background: rgba(255, 255, 255, 0.15) !important;
        border-color: rgba(255, 255, 255, 0.3) !important;
        transform: translateX(10px);
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .submit-btn.loading span { opacity: 0; }
    .submit-btn.loading .opacity-0 { opacity: 1 !important; }

    .alert {
        animation: slideInDown 0.3s ease-out;
    }

    @keyframes slideInDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @media (max-width: 991.98px) {
        .card {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
        }
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const emailInput = document.querySelector('#email');
    const passwordInput = document.querySelector('#password');
    const submitBtn = document.querySelector('.submit-btn');
    const passwordReveal = document.querySelector('.password-reveal');
    const applicantLoginUrl = '{{ route("login.applicant") }}';
    
    // Enhanced security check for personal/job seeker domains
    const jobSeekerDomains = [
        'gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 
        'icloud.com', 'protonmail.com', 'aol.com', 'live.com'
    ];
    
    // Validation functions
    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
    
    function validatePassword(password) {
        return password.length >= 6;
    }
    
    function isJobSeekerEmail(email) {
        const domain = email.split('@')[1];
        return jobSeekerDomains.some(jobSeekerDomain => domain && domain.toLowerCase() === jobSeekerDomain.toLowerCase());
    }
    
    function showError(input, message) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        const feedback = input.parentElement.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = message;
        }
    }
    
    function showSuccess(input) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    }
    
    function clearError(input) {
        input.classList.remove('is-invalid', 'is-valid');
        const feedback = input.parentElement.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = '';
        }
    }
    
    function showJobSeekerWarning() {
        // Remove existing alerts first
        const existingAlerts = document.querySelectorAll('.alert-warning');
        existingAlerts.forEach(alert => alert.remove());
        
        // Create new alert
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-warning alert-dismissible fade show mb-4';
        alertDiv.setAttribute('role', 'alert');
        alertDiv.innerHTML = 
            '<div class="d-flex align-items-center">' +
                '<i class="fas fa-user me-2"></i>' +
                '<div>' +
                    '<strong>Personal Email Detected!</strong><br>' +
                    'This appears to be a personal email. Job seekers should use the <a href="' + applicantLoginUrl + '" class="alert-link">Job Seeker Login Portal</a> instead.' +
                '</div>' +
            '</div>' +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        
        const cardBody = document.querySelector('.card-body');
        if (cardBody) {
            cardBody.insertBefore(alertDiv, cardBody.firstChild);
        }
    }
    
    // Real-time validation
    if (emailInput) {
        emailInput.addEventListener('input', function() {
            clearError(this);
        });
        
        emailInput.addEventListener('blur', function() {
            if (this.value && !validateEmail(this.value)) {
                showError(this, 'Please enter a valid email address');
            } else if (this.value && isJobSeekerEmail(this.value)) {
                showError(this, 'Personal emails should use the Job Seeker Login Portal');
                showJobSeekerWarning();
            } else if (this.value) {
                showSuccess(this);
            }
        });
    }
    
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            clearError(this);
        });
        
        passwordInput.addEventListener('blur', function() {
            if (this.value && !validatePassword(this.value)) {
                showError(this, 'Password must be at least 6 characters long');
            } else if (this.value) {
                showSuccess(this);
            }
        });
    }
    
    // Password reveal
    if (passwordReveal) {
        passwordReveal.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    }
    
    // Enhanced form submission with job seeker blocking
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isValid = true;
            
            // Reset previous states
            if (emailInput) emailInput.classList.remove('is-invalid', 'is-valid');
            if (passwordInput) passwordInput.classList.remove('is-invalid', 'is-valid');
            
            // Email validation
            if (!emailInput || !emailInput.value) {
                if (emailInput) showError(emailInput, 'Email is required');
                isValid = false;
            } else if (!validateEmail(emailInput.value)) {
                showError(emailInput, 'Please enter a valid email address');
                isValid = false;
            } else if (isJobSeekerEmail(emailInput.value)) {
                showError(emailInput, 'Personal emails must use the Job Seeker Login Portal');
                showJobSeekerWarning();
                isValid = false;
                
                // Redirect to job seeker login after 2 seconds
                setTimeout(function() {
                    window.location.href = applicantLoginUrl;
                }, 2000);
                
            } else {
                showSuccess(emailInput);
            }
            
            // Password validation
            if (!passwordInput || !passwordInput.value) {
                if (passwordInput) showError(passwordInput, 'Password is required');
                isValid = false;
            } else if (!validatePassword(passwordInput.value)) {
                showError(passwordInput, 'Password must be at least 6 characters long');
                isValid = false;
            } else {
                showSuccess(passwordInput);
            }
            
            if (isValid) {
                if (submitBtn) {
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;
                }
                setTimeout(function() {
                    form.submit();
                }, 1000);
            } else {
                const firstInvalid = form.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.focus();
                }
            }
        });
    }
    
    // Feature cards interaction
    document.querySelectorAll('.feature-card').forEach(function(card) {
        card.addEventListener('click', function() {
            document.querySelectorAll('.feature-card').forEach(function(c) {
                c.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
    
    // Auto-dismiss alerts after 5 seconds
    document.querySelectorAll('.alert').forEach(function(alert) {
        setTimeout(function() {
            if (alert && alert.parentNode && typeof bootstrap !== 'undefined') {
                try {
                    const bootstrapAlert = new bootstrap.Alert(alert);
                    bootstrapAlert.close();
                } catch (e) {
                    console.log('Bootstrap alert error:', e);
                }
            }
        }, 5000);
    });
});

function showSupportModal() {
    if (typeof bootstrap !== 'undefined') {
        try {
            new bootstrap.Modal(document.getElementById('supportModal')).show();
        } catch (e) {
            console.log('Bootstrap modal error:', e);
        }
    }
}
</script>
@endsection