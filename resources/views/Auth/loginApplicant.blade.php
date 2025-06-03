@extends('layouts.app')

@section('content')
<div class="login-wrapper position-relative min-vh-100">
    <!-- Animated Background dengan Bootstrap utilities -->
    <div class="position-fixed top-0 start-0 w-100 h-100" style="z-index: -1; background: linear-gradient(135deg, #10b981 0%, #06b6d4 50%, #059669 100%);">
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
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h3 class="mb-0">JobMatch</h3>
                                <span class="opacity-75">for Job Seekers</span>
                            </div>
                        </div>
                    </nav>
                    
                    <!-- Main Content dengan Bootstrap flex utilities -->
                    <div class="flex-grow-1 d-flex flex-column">
                        <div class="mb-5">
                            <!-- Hero badge dengan Bootstrap badge utilities -->
                            <div class="d-inline-flex align-items-center mb-4 px-3 py-2 rounded-pill border border-white border-opacity-25" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px);">
                                <i class="fas fa-star me-2"></i>
                                <span class="fw-semibold small">Smart Career Platform</span>
                            </div>
                            
                            <!-- Hero title dengan Bootstrap typography -->
                            <h1 class="display-2 fw-bold lh-1 mb-4" style="letter-spacing: -0.02em;">
                                Find Your Dream<br>
                                <span class="text-warning">Career Today</span>
                            </h1>
                            
                            <p class="fs-5 opacity-75">
                                Join 50,000+ professionals who found their perfect job through our AI-powered matching system.
                            </p>
                        </div>
                        
                        <!-- Interactive Features dengan Bootstrap cards -->
                        <div class="mb-5">
                            <!-- Feature Card 1 -->
                            <div class="d-flex align-items-center gap-4 p-4 mb-3 rounded-3 border border-white border-opacity-25 feature-card active" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); cursor: pointer; transition: all 0.3s ease;">
                                <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-3" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.15);">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div>
                                    <h4 class="mb-2">Smart Job Matching</h4>
                                    <p class="mb-2 opacity-75">AI algorithms match you with jobs based on skills, experience, and preferences</p>
                                    <div class="d-flex align-items-baseline">
                                        <span class="fs-3 fw-bold text-warning">98%</span>
                                        <span class="ms-2 small opacity-75">Match Success Rate</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Feature Card 2 -->
                            <div class="d-flex align-items-center gap-4 p-4 mb-3 rounded-3 border border-white border-opacity-25 feature-card" style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(10px); cursor: pointer; transition: all 0.3s ease;">
                                <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-3" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.15);">
                                    <i class="fas fa-rocket"></i>
                                </div>
                                <div>
                                    <h4 class="mb-2">Fast Application Process</h4>
                                    <p class="mb-2 opacity-75">Apply to multiple jobs with one click using our smart application system</p>
                                    <div class="d-flex align-items-baseline">
                                        <span class="fs-3 fw-bold text-warning">5x</span>
                                        <span class="ms-2 small opacity-75">Faster Applications</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Feature Card 3 -->
                            <div class="d-flex align-items-center gap-4 p-4 mb-3 rounded-3 border border-white border-opacity-25 feature-card" style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(10px); cursor: pointer; transition: all 0.3s ease;">
                                <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-3" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.15);">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div>
                                    <h4 class="mb-2">Career Growth Insights</h4>
                                    <p class="mb-2 opacity-75">Track your career progress and get personalized recommendations</p>
                                    <div class="d-flex align-items-baseline">
                                        <span class="fs-3 fw-bold text-warning">24/7</span>
                                        <span class="ms-2 small opacity-75">Career Support</span>
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
                        <a href="{{ route('home') }}" class="btn btn-light btn-sm d-flex align-items-center gap-2 text-decoration-none border border-success text-success" 
                           style="transition: all 0.3s ease;"
                           onmouseenter="this.classList.add('shadow-lg', 'btn-success', 'text-white'); this.classList.remove('btn-light', 'text-success'); this.style.transform='translateX(-5px)'"
                           onmouseleave="this.classList.remove('shadow-lg', 'btn-success', 'text-white'); this.classList.add('btn-light', 'text-success'); this.style.transform='translateX(0)'">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back to Site</span>
                        </a>
                    </div>
                    
                    <!-- Mobile Header dengan Bootstrap display utilities -->
                    <div class="d-lg-none text-center mb-4 py-4">
                        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-3 bg-success text-white" style="width: 60px; height: 60px;">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h2 class="mb-2">Job Seeker Login</h2>
                        <p class="text-muted">Access your career dashboard</p>
                    </div>
                    
                    <!-- Login Card dengan Bootstrap card -->
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden position-relative">
                        <!-- Top gradient bar dengan Bootstrap utilities -->
                        <div class="position-absolute top-0 start-0 end-0 bg-gradient" style="height: 4px; background: linear-gradient(90deg, #10b981 0%, #06b6d4 100%);"></div>
                        
                        <!-- Card Header dengan Bootstrap spacing -->
                        <div class="card-header bg-transparent border-0 pt-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="d-none d-lg-flex align-items-center justify-content-center rounded-3 text-white" style="width: 50px; height: 50px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div>
                                    <h2 class="mb-1">Welcome Back</h2>
                                    <p class="text-muted mb-0">Continue your job search journey</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Login Form dengan Bootstrap form components -->
                        <div class="card-body">
                            <form action="{{ route('applicant.login.post') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                
                                <!-- Email Field dengan Bootstrap input group -->
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-semibold">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" id="email" name="email" class="form-control border-start-0" placeholder="Enter your email address" required autocomplete="email">
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                
                                <!-- Password Field dengan Bootstrap input group -->
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password" id="password" name="password" class="form-control border-start-0" placeholder="Enter your password" required autocomplete="current-password">
                                        <button type="button" class="btn btn-light border border-start-0 password-reveal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                
                                <!-- Form Options dengan Bootstrap flex utilities -->
                                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">Keep me signed in</label>
                                    </div>
                                    <a href="#" class="text-decoration-none fw-semibold text-success">Forgot password?</a>
                                </div>
                                
                                <!-- Submit Button dengan Bootstrap button -->
                                <button type="submit" class="btn btn-success w-100 py-3 position-relative overflow-hidden mb-4 fw-semibold fs-6 submit-btn" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none;">
                                    <span class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-sign-in-alt me-2"></i>
                                        Sign In to Dashboard
                                    </span>
                                    <div class="position-absolute top-50 start-50 translate-middle opacity-0">
                                        <div class="spinner-border spinner-border-sm text-light" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </button>
                                
                                <!-- Social Login dengan Bootstrap grid -->
                                <div class="text-center mb-4">
                                    <div class="position-relative">
                                        <hr>
                                        <span class="position-absolute top-50 start-50 translate-middle px-3 bg-white text-muted small">Or continue with</span>
                                    </div>
                                </div>
                                
                                <div class="row g-2 mb-4">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                                            <i class="fab fa-google"></i>
                                            <span class="small">Google</span>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                                            <i class="fab fa-linkedin"></i>
                                            <span class="small">LinkedIn</span>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Notices dengan Bootstrap alerts -->
                                <div class="d-flex align-items-start gap-3 bg-info bg-opacity-10 p-3 rounded-3 border border-info border-opacity-25 mb-4">
                                    <div class="text-info">
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block mb-1">Career Tips Available</strong>
                                        <p class="small text-muted mb-0">Get personalized career advice and job recommendations</p>
                                    </div>
                                </div>
                                
                                <!-- Register Section dengan Bootstrap utilities -->
                                <div class="text-center p-3 bg-light rounded-3 mb-4 border">
                                    <p class="text-muted mb-2">Don't have an account?</p>
                                    <a href="{{ route('register.applicant') }}" class="text-decoration-none fw-semibold text-success">
                                        Create Job Seeker Account
                                        <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                                
                                <!-- Alternative Actions dengan Bootstrap grid -->
                                <div class="position-relative text-center my-4">
                                    <hr>
                                    <span class="position-absolute top-50 start-50 translate-middle px-3 bg-white text-muted small">Other options</span>
                                </div>
                                
                                <div class="row g-1">
                                    <div class="col-md-6">
                                        <a href="{{ route('login.company') }}" class="btn btn-outline-secondary text-start d-flex align-items-center gap-3 p-3 w-100">
                                            <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-light rounded-2" style="width: 30px; height: 40px;">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <div>
                                                <span class="d-block fw-semibold">Company Login</span>
                                                <span class="small text-muted">Are you an employer?</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
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
                <h5 class="modal-title fw-bold" id="supportModalLabel">Get Support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush">
                    <a href="mailto:support@jobmatch.com" class="list-group-item list-group-item-action d-flex align-items-center gap-3 p-3">
                        <i class="fas fa-envelope text-primary fs-4"></i>
                        <div>
                            <strong class="d-block">Email Support</strong>
                            <p class="mb-0 text-muted">support@jobmatch.com</p>
                        </div>
                    </a>
                    <a href="tel:+6221-1234-5678" class="list-group-item list-group-item-action d-flex align-items-center gap-3 p-3">
                        <i class="fas fa-phone text-success fs-4"></i>
                        <div>
                            <strong class="d-block">Phone Support</strong>
                            <p class="mb-0 text-muted">+62-21-1234-5678</p>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center gap-3 p-3">
                        <i class="fas fa-comments text-warning fs-4"></i>
                        <div>
                            <strong class="d-block">Live Chat</strong>
                            <p class="mb-0 text-muted">Available 9 AM - 6 PM WIB</p>
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

    /* Minimal custom CSS - hanya untuk animasi yang tidak ada di Bootstrap */
    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(50px, -50px) rotate(90deg); }
        50% { transform: translate(-30px, 40px) rotate(180deg); }
        75% { transform: translate(40px, 30px) rotate(270deg); }
    }

    /* Feature card hover effects */
    .feature-card:hover {
        background: rgba(255, 255, 255, 0.15) !important;
        border-color: rgba(255, 255, 255, 0.3) !important;
        transform: translateX(10px);
    }

    /* Button hover effects */
    .btn:hover {
        transform: translateY(-2px);
    }

    /* Submit button loading state */
    .submit-btn.loading span { opacity: 0; }
    .submit-btn.loading .opacity-0 { opacity: 1 !important; }

    /* Mobile responsive */
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
    
    // Validation functions
    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
    
    function validatePassword(password) {
        return password.length >= 6;
    }
    
    function showError(input, message) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        input.parentElement.nextElementSibling.textContent = message;
    }
    
    function showSuccess(input) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    }
    
    // Email validation
    emailInput.addEventListener('blur', function() {
        if (this.value && !validateEmail(this.value)) {
            showError(this, 'Please enter a valid email address');
        } else if (this.value) {
            showSuccess(this);
        }
    });
    
    // Password validation
    passwordInput.addEventListener('blur', function() {
        if (this.value && !validatePassword(this.value)) {
            showError(this, 'Password must be at least 6 characters long');
        } else if (this.value) {
            showSuccess(this);
        }
    });
    
    // Password reveal
    passwordReveal.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        
        if (!emailInput.value) {
            showError(emailInput, 'Email is required');
            isValid = false;
        } else if (!validateEmail(emailInput.value)) {
            showError(emailInput, 'Please enter a valid email address');
            isValid = false;
        }
        
        if (!passwordInput.value) {
            showError(passwordInput, 'Password is required');
            isValid = false;
        } else if (!validatePassword(passwordInput.value)) {
            showError(passwordInput, 'Password must be at least 6 characters long');
            isValid = false;
        }
        
        if (isValid) {
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
            setTimeout(() => form.submit(), 1000);
        }
    });
    
    // Feature cards interaction
    document.querySelectorAll('.feature-card').forEach(card => {
        card.addEventListener('click', function() {
            document.querySelectorAll('.feature-card').forEach(c => c.classList.remove('active'));
            this.classList.add('active');
        });
    });
});

function showSupportModal() {
    new bootstrap.Modal(document.getElementById('supportModal')).show();
}
</script>
@endsection