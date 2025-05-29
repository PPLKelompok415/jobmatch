@extends('layouts.app')

@section('content')
<div class="login-container min-vh-100 d-flex align-items-center">
    <!-- Background Elements -->
    <div class="login-bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="login-card shadow-lg">
                    <!-- Header -->
                        <a href="{{ route('home') }}" class="back-to-site">
                            <i class="fas fa-arrow-left me-2"></i>Back to Site
                        </a>
                    <div class="login-header text-center mb-4">
                        <div class="login-icon mb-3">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-2">Welcome Back!</h2>
                        <p class="text-muted">Sign in to continue your job search journey</p>
                    </div>

                    <!-- Login Form -->
                    <form action="{{ route('applicant.login.post') }}" method="POST" class="login-form">
                        @csrf
                        
                        <!-- Email Input -->
                        <div class="form-group mb-4">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-envelope text-primary"></i>
                                </span>
                                <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" 
                                       placeholder="Enter your email address" required>
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="form-group mb-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" 
                                       placeholder="Enter your password" required>
                                <button class="btn btn-outline-secondary border-start-0 password-toggle" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label text-sm" for="remember">
                                    Remember me
                                </label>
                            </div>
                            <a href="#" class="text-primary text-decoration-none small fw-semibold">Forgot Password?</a>
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-primary w-100 btn-lg mb-4 login-btn">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Sign In
                        </button>

                        <!-- Divider -->
                        <div class="login-divider mb-4">
                            <span class="divider-text">Or continue with</span>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="row g-2 mb-4">
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-danger w-100 social-btn">
                                    <i class="fab fa-google me-2"></i>Google
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-primary w-100 social-btn">
                                    <i class="fab fa-linkedin me-2"></i>LinkedIn
                                </button>
                            </div>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Don't have an account? 
                                <a href="{{ route('register.applicant') }}" class="text-primary fw-semibold text-decoration-none">
                                    Create Account
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Company Login Link -->
                <div class="text-center mt-4">
                    <p class="text-muted">
                        Are you a company? 
                        <a href="{{ route('login.company') }}" class="text-primary fw-semibold text-decoration-none">
                            <i class="fas fa-building me-1"></i>Company Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
    :root {
        --primary-color: #4f46e5;
        --primary-light: #818cf8;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --warning-color: #f59e0b;
    }

    body {
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .login-container {
        position: relative;
        overflow: hidden;
    }

    /* Background Shapes */
    .login-bg-shapes {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .shape-1 {
        width: 80px;
        height: 80px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 120px;
        height: 120px;
        top: 70%;
        right: 10%;
        animation-delay: 2s;
    }

    .shape-3 {
        width: 60px;
        height: 60px;
        top: 50%;
        left: 80%;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    /* Login Card */
    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 2.5rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        z-index: 10;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    }

    .login-icon {
        font-size: 4rem;
        color: var(--primary-color);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    /* Form Styles */
    .form-label {
        color: #374151;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.875rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        background: white;
    }

    .input-group-text {
        border: 2px solid #e5e7eb;
        border-radius: 12px 0 0 12px;
        background: #f9fafb;
        color: #6b7280;
    }

    .input-group .form-control {
        border-radius: 0 12px 12px 0;
    }

    .password-toggle {
        border: 2px solid #e5e7eb;
        border-left: none;
        border-radius: 0 12px 12px 0;
        background: #f9fafb;
        color: #6b7280;
        transition: all 0.3s ease;
    }

    .password-toggle:hover {
        background: #e5e7eb;
        color: var(--primary-color);
    }

    /* Login Button */
    .login-btn {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        border: none;
        border-radius: 12px;
        padding: 0.875rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
    }

    /* Divider */
    .login-divider {
        position: relative;
        text-align: center;
    }

    .login-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e5e7eb;
    }

    .divider-text {
        background: rgba(255, 255, 255, 0.95);
        padding: 0 1rem;
        color: #6b7280;
        font-size: 0.875rem;
    }

    /* Social Buttons */
    .social-btn {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
    }

    .social-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        background: white;
    }

    /* Form Check */
    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-card {
            padding: 2rem 1.5rem;
            margin: 1rem;
        }
        
        .login-icon {
            font-size: 3rem;
        }
        
        .shape {
            display: none;
        }
    }

    /* Animation */
    .login-card {
        animation: slideInUp 0.6s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality
    const passwordToggle = document.querySelector('.password-toggle');
    const passwordInput = document.querySelector('#password');
    
    if (passwordToggle && passwordInput) {
        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    }

    // Social login buttons
    document.querySelectorAll('.social-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const platform = this.textContent.trim();
            alert(`${platform} login will be implemented soon!`);
        });
    });

    // Form validation and enhancement
    const form = document.querySelector('.login-form');
    const inputs = form.querySelectorAll('.form-control');
    
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
            if (this.value.trim() !== '') {
                this.classList.add('has-value');
            } else {
                this.classList.remove('has-value');
            }
        });
    });

    // Button click animation
    const loginBtn = document.querySelector('.login-btn');
    loginBtn.addEventListener('click', function(e) {
        // Create ripple effect
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(255, 255, 255, 0.3)';
        ripple.style.transform = 'scale(0)';
        ripple.style.animation = 'ripple 0.6s linear';
        ripple.style.pointerEvents = 'none';
        
        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });

    // Add ripple animation CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    console.log('Applicant login page initialized successfully!');
});
</script>
@endsection