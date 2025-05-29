@extends('layouts.app')

@section('title', 'Admin Login')

@section('styles')
<style>
    .admin-login-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        position: relative;
        overflow: hidden;
    }

    .admin-login-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .admin-login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 3rem;
        width: 100%;
        max-width: 450px;
        position: relative;
        z-index: 2;
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

    .admin-brand {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .admin-brand-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 2rem;
        box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
        position: relative;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
        }
        50% {
            box-shadow: 0 15px 40px rgba(255, 107, 107, 0.5);
        }
        100% {
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
        }
    }

    .admin-brand-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #2d3748;
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }

    .admin-brand-subtitle {
        color: #718096;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-floating .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem 1rem 1rem 3rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
    }

    .form-floating .form-control:focus {
        border-color: #ff6b6b;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.15);
        background: rgba(255, 255, 255, 0.95);
    }

    .form-floating .form-control:focus + .form-label,
    .form-floating .form-control:not(:placeholder-shown) + .form-label {
        opacity: 0.65;
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
        color: #ff6b6b;
    }

    .form-floating .form-label {
        position: absolute;
        top: 50%;
        left: 3rem;
        transform: translateY(-50%);
        color: #718096;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
        pointer-events: none;
        z-index: 2;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        z-index: 3;
        transition: all 0.3s ease;
    }

    .form-floating .form-control:focus ~ .input-icon {
        color: #ff6b6b;
    }

    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #a0aec0;
        cursor: pointer;
        z-index: 3;
        transition: all 0.3s ease;
    }

    .password-toggle:hover {
        color: #ff6b6b;
    }

    .form-check {
        margin-bottom: 2rem;
    }

    .form-check-input {
        border-radius: 6px;
        border: 2px solid #e2e8f0;
        width: 1.25rem;
        height: 1.25rem;
        transition: all 0.3s ease;
    }

    .form-check-input:checked {
        background-color: #ff6b6b;
        border-color: #ff6b6b;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.15);
    }

    .form-check-label {
        font-weight: 500;
        color: #4a5568;
        margin-left: 0.5rem;
    }

    .admin-login-btn {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        border: none;
        border-radius: 12px;
        padding: 1rem 2rem;
        font-size: 1rem;
        font-weight: 600;
        color: white;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        position: relative;
        overflow: hidden;
    }

    .admin-login-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .admin-login-btn:hover::before {
        left: 100%;
    }

    .admin-login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
    }

    .admin-login-btn:active {
        transform: translateY(0);
    }

    .alert {
        border: none;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        font-weight: 500;
        backdrop-filter: blur(10px);
    }

    .alert-danger {
        background: rgba(254, 202, 202, 0.9);
        color: #c53030;
        border-left: 4px solid #f56565;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        font-weight: 500;
        margin-top: 0.5rem;
        color: #e53e3e;
    }

    .form-control.is-invalid {
        border-color: #e53e3e;
        background-color: rgba(254, 202, 202, 0.1);
    }

    .security-notice {
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.2);
        border-radius: 12px;
        padding: 1rem;
        margin-top: 2rem;
        text-align: center;
        color: #2b6cb0;
        font-size: 0.875rem;
    }

    .security-notice i {
        color: #3182ce;
        margin-right: 0.5rem;
    }

    .back-to-home {
        position: absolute;
        top: 2rem;
        left: 2rem;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        z-index: 3;
    }

    .back-to-home:hover {
        color: white;
        transform: translateX(-5px);
    }

    @media (max-width: 768px) {
        .admin-login-card {
            padding: 2rem;
            margin: 1rem;
        }
        
        .back-to-home {
            top: 1rem;
            left: 1rem;
        }
    }

    /* Loading animation */
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
</style>
@endsection

@section('content')
<div class="admin-login-container">
    <a href="{{ url('/') }}" class="back-to-home">
        <i class="fas fa-arrow-left me-2"></i>Back to Home
    </a>
    
    <div class="admin-login-card">
        <div class="admin-brand">
            <div class="admin-brand-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h1 class="admin-brand-title">Admin Portal</h1>
            <p class="admin-brand-subtitle">Secure access to administrative panel</p>
        </div>

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.admin.post') }}" id="adminLoginForm">
            @csrf
            
            <div class="form-floating">
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autocomplete="email"
                       placeholder="admin@jobmatch.com">
                <label for="email">Email Address</label>
                <i class="fas fa-envelope input-icon"></i>
                @error('email')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating">
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       id="password" 
                       name="password" 
                       required 
                       autocomplete="current-password"
                       placeholder="Password">
                <label for="password">Password</label>
                <i class="fas fa-lock input-icon"></i>
                <button type="button" class="password-toggle" onclick="togglePassword()">
                    <i class="fas fa-eye" id="passwordIcon"></i>
                </button>
                @error('password')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-check">
                <input class="form-check-input" 
                       type="checkbox" 
                       name="remember" 
                       id="remember" 
                       {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Keep me signed in
                </label>
            </div>

            <button type="submit" class="admin-login-btn" id="loginButton">
                <i class="fas fa-sign-in-alt me-2"></i>
                <span class="btn-text">Access Admin Panel</span>
            </button>
        </form>

        <div class="security-notice">
            <i class="fas fa-info-circle"></i>
            <strong>Security Notice:</strong> This is a restricted area. All login attempts are monitored and logged.
        </div>
    </div>
</div>
@endsection

@section('scripts')
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
        
        // Show loading spinner
        const loadingSpinner = document.getElementById('loadingSpinner');
        if (loadingSpinner) {
            loadingSpinner.style.display = 'flex';
        }
    });

    // Enhanced form validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('adminLoginForm');
        const inputs = form.querySelectorAll('input[required]');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateInput(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    validateInput(this);
                }
            });
        });
        
        function validateInput(input) {
            const value = input.value.trim();
            const type = input.type;
            
            if (!value) {
                addError(input, 'This field is required');
                return false;
            }
            
            if (type === 'email' && !isValidEmail(value)) {
                addError(input, 'Please enter a valid email address');
                return false;
            }
            
            if (input.name === 'password' && value.length < 6) {
                addError(input, 'Password must be at least 6 characters');
                return false;
            }
            
            removeError(input);
            return true;
        }
        
        function addError(input, message) {
            input.classList.add('is-invalid');
            let feedback = input.parentNode.querySelector('.invalid-feedback');
            if (!feedback) {
                feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                input.parentNode.appendChild(feedback);
            }
            feedback.innerHTML = `<i class="fas fa-exclamation-circle me-1"></i>${message}`;
        }
        
        function removeError(input) {
            input.classList.remove('is-invalid');
            const feedback = input.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.remove();
            }
        }
        
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    });

    // Auto-focus email field on page load
    window.addEventListener('load', function() {
        document.getElementById('email').focus();
    });
</script>
@endsection