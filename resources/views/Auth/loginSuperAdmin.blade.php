@extends('layouts.app')

@section('title', 'Admin Login')

@section('styles')
<style>
    .auth-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        position: relative;
        overflow: hidden;
    }

    .auth-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60"><g fill="none" fill-rule="evenodd"><g fill="rgba(255,255,255,0.03)" fill-opacity="0.4"><circle cx="30" cy="30" r="1"/></g></svg>') repeat;
        animation: float 20s infinite linear;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        100% { transform: translateY(-60px); }
    }

    .auth-left {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border-right: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
    }

    .auth-left::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(255, 107, 107, 0.1), rgba(238, 90, 82, 0.1));
        opacity: 0.5;
    }

    .brand-logo {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        border-radius: 25px;
        color: white;
        font-size: 2.5rem;
        box-shadow: 0 20px 60px rgba(255, 107, 107, 0.3);
        animation: pulse-glow 3s ease-in-out infinite;
        position: relative;
        z-index: 3;
    }

    @keyframes pulse-glow {
        0%, 100% {
            box-shadow: 0 20px 60px rgba(255, 107, 107, 0.3);
            transform: scale(1);
        }
        50% {
            box-shadow: 0 25px 80px rgba(255, 107, 107, 0.5);
            transform: scale(1.02);
        }
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: slideInRight 0.8s ease-out;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .input-group-text {
        background: rgba(255, 255, 255, 0.8);
        border: 2px solid #e2e8f0;
        border-right: none;
    }

    .form-control {
        border: 2px solid #e2e8f0;
        border-left: none;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
    }

    .form-control:focus {
        border-color: #ff6b6b;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.15);
        background: rgba(255, 255, 255, 0.95);
    }

    .form-control:focus + .input-group-text {
        border-color: #ff6b6b;
    }

    .btn-admin {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        border: none;
        color: white;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-admin::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-admin:hover::before {
        left: 100%;
    }

    .btn-admin:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
    }

    .btn-loading {
        position: relative;
        color: transparent !important;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .features-list li::before {
        content: '\f00c';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        color: #ff6b6b;
        margin-right: 0.5rem;
    }

    .back-link {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .back-link:hover {
        color: white;
        background: rgba(255, 255, 255, 0.2);
        transform: translateX(-5px);
    }

    .password-toggle {
        background: none;
        border: none;
        color: #a0aec0;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .password-toggle:hover {
        color: #ff6b6b;
    }
</style>
@endsection

@section('content')
<div class="auth-container">
    <a href="{{ url('/') }}" class="back-link btn position-absolute top-0 start-0 m-4 z-3">
        <i class="fas fa-arrow-left me-2"></i>
        <span>Back to Home</span>
    </a>

    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Left Side - Branding -->
            <div class="col-md-6 auth-left d-none d-md-flex flex-column justify-content-center align-items-center text-center p-5 position-relative">
                <div class="brand-logo d-flex align-items-center justify-content-center mb-4">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h1 class="display-4 fw-bold text-white mb-3 position-relative" style="z-index: 3; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                    Admin Panel
                </h1>
                <p class="lead text-white-50 mb-4 position-relative" style="z-index: 3;">
                    Secure administrative access to JobMatch platform
                </p>
                
                <ul class="list-unstyled features-list position-relative" style="z-index: 3;">
                    <li class="text-white mb-3 fw-medium">Complete user management</li>
                    <li class="text-white mb-3 fw-medium">Advanced analytics dashboard</li>
                    <li class="text-white mb-3 fw-medium">System monitoring tools</li>
                    <li class="text-white mb-3 fw-medium">Security & compliance controls</li>
                </ul>
            </div>

            <!-- Right Side - Login Form -->
            <div class="col-md-6 d-flex align-items-center justify-content-center p-5">
                <div class="login-card card shadow-lg border-0 rounded-4 p-5" style="max-width: 450px; width: 100%;">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h2 class="h3 fw-bold text-dark mb-2">Admin Login</h2>
                            <p class="text-muted">Enter your credentials to access the admin panel</p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger border-0 rounded-3" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.admin.post') }}" id="adminLoginForm">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold text-dark">
                                    <i class="fas fa-envelope me-1"></i>
                                    Email Address
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-3">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control rounded-end-3 @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required 
                                           autocomplete="email"
                                           placeholder="admin@jobmatch.com">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold text-dark">
                                    <i class="fas fa-lock me-1"></i>
                                    Password
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-3">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           required 
                                           autocomplete="current-password"
                                           placeholder="Enter your password">
                                    <span class="input-group-text rounded-end-3">
                                        <button type="button" class="password-toggle" onclick="togglePassword()">
                                            <i class="fas fa-eye" id="passwordIcon"></i>
                                        </button>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="remember" 
                                       id="remember" 
                                       {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium text-dark" for="remember">
                                    Keep me signed in for 30 days
                                </label>
                            </div>

                            <button type="submit" class="btn btn-admin w-100 py-3 rounded-3 fw-semibold" id="loginButton">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                <span class="btn-text">Access Admin Panel</span>
                            </button>
                        </form>

                        <div class="alert alert-info border-0 rounded-3 mt-4 text-center" role="alert">
                            <i class="fas fa-shield-check me-2"></i>
                            <strong>Security Notice:</strong> This is a restricted area. All activities are monitored and logged for security purposes.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    }

    document.getElementById('adminLoginForm').addEventListener('submit', function(e) {
        const loginButton = document.getElementById('loginButton');
        const buttonText = loginButton.querySelector('.btn-text');
        
        // Disable button and show loading state
        loginButton.disabled = true;
        loginButton.classList.add('btn-loading');
        buttonText.textContent = 'Authenticating...';
    });

    // Auto-focus email field on page load
    window.addEventListener('load', function() {
        document.getElementById('email').focus();
    });
</script>
@endpush