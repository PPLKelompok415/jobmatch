@extends('layouts.app')

@section('content')
<div class="ultimate-login-wrapper">
    <!-- Animated Background -->
    <div class="animated-background">
        <div class="gradient-orbs">
            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>
            <div class="orb orb-3"></div>
            <div class="orb orb-4"></div>
        </div>
        <div class="floating-particles"></div>
    </div>
    
    <div class="container-fluid">
        <div class="row min-vh-100 g-0">
            <!-- Left Panel - Brand Showcase -->
            <div class="col-lg-7 xl-col-6 brand-panel">
                <div class="brand-showcase">
                    <!-- Navigation -->
                    <nav class="brand-nav">
                        <div class="brand-logo">
                            <div class="logo-container">
                                <div class="logo-icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div class="logo-text">
                                    <h3>JobMatch</h3>
                                    <span>for Companies</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('home') }}" class="back-to-site">
                            <i class="fas fa-arrow-left me-2"></i>Back to Site
                        </a>
                    </nav>
                    
                    <!-- Main Content -->
                    <div class="showcase-content">
                        <div class="hero-section">
                            <div class="hero-badge">
                                <i class="fas fa-crown me-2"></i>
                                <span>Premium Recruitment Platform</span>
                            </div>
                            <h1 class="hero-title">
                                Transform Your<br>
                                <span class="gradient-text">Hiring Process</span>
                            </h1>
                            <p class="hero-description">
                                Join 2,500+ companies using AI-powered matching to find exceptional talent faster than ever before.
                            </p>
                        </div>
                        
                        <!-- Interactive Features -->
                        <div class="features-interactive">
                            <div class="feature-card active" data-feature="matching">
                                <div class="feature-icon">
                                    <i class="fas fa-magic"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>AI-Powered Matching</h4>
                                    <p>Advanced algorithms analyze 200+ data points to find perfect candidates</p>
                                    <div class="feature-metric">
                                        <span class="metric-value">95%</span>
                                        <span class="metric-label">Match Accuracy</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="feature-card" data-feature="speed">
                                <div class="feature-icon">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Lightning Fast Hiring</h4>
                                    <p>Reduce time-to-hire from weeks to days with automated screening</p>
                                    <div class="feature-metric">
                                        <span class="metric-value">3x</span>
                                        <span class="metric-label">Faster Hiring</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="feature-card" data-feature="analytics">
                                <div class="feature-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Advanced Analytics</h4>
                                    <p>Real-time insights and predictive analytics for better decisions</p>
                                    <div class="feature-metric">
                                        <span class="metric-value">360°</span>
                                        <span class="metric-label">View Analytics</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Success Stories -->
                        <div class="success-stories">
                            <h3>Trusted by Industry Leaders</h3>
                            <div class="company-logos">
                                <div class="company-logo">
                                    <div class="logo-placeholder">Tech</div>
                                </div>
                                <div class="company-logo">
                                    <div class="logo-placeholder">Start</div>
                                </div>
                                <div class="company-logo">
                                    <div class="logo-placeholder">Corp</div>
                                </div>
                                <div class="company-logo">
                                    <div class="logo-placeholder">Labs</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Panel - Login Form -->
            <div class="col-lg-5 xl-col-6 login-panel">
                <div class="login-container">
                    <!-- Mobile Header -->
                    <div class="mobile-header d-lg-none">
                        <div class="mobile-logo">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h2>Company Login</h2>
                        <p>Access your recruitment dashboard</p>
                    </div>
                    
                    <!-- Login Card -->
                    <div class="ultimate-login-card">
                        <!-- Card Header -->
                        <div class="card-header">
                            <div class="header-icon d-none d-lg-flex">
                                <i class="fas fa-shield-check"></i>
                            </div>
                            <div class="header-content">
                                <h2>Welcome Back</h2>
                                <p>Sign in to your company dashboard</p>
                            </div>
                        </div>
                        
                        <!-- Login Form -->
                        <form action="{{ route('company.login.post') }}" method="POST" class="ultimate-form" novalidate>
                            @csrf
                            
                            <!-- Email Field -->
                            <div class="form-field">
                                <label for="email" class="field-label">Company Email Address</label>
                                <div class="input-container">
                                    <div class="input-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        class="field-input" 
                                        placeholder="Enter your company email"
                                        required
                                        autocomplete="email"
                                    >
                                    <div class="input-highlight"></div>
                                    <div class="field-error"></div>
                                </div>
                            </div>
                            
                            <!-- Password Field -->
                            <div class="form-field">
                                <label for="password" class="field-label">Password</label>
                                <div class="input-container">
                                    <div class="input-icon">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <input 
                                        type="password" 
                                        id="password" 
                                        name="password" 
                                        class="field-input" 
                                        placeholder="Enter your password"
                                        required
                                        autocomplete="current-password"
                                    >
                                    <button type="button" class="password-reveal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="input-highlight"></div>
                                    <div class="field-error"></div>
                                </div>
                            </div>
                            
                            <!-- Form Options -->
                            <div class="form-options">
                                <div class="checkbox-container">
                                    <input type="checkbox" id="remember" name="remember" class="custom-checkbox">
                                    <label for="remember" class="checkbox-label">
                                        <span class="checkbox-indicator"></span>
                                        <span class="checkbox-text">Keep me signed in</span>
                                    </label>
                                </div>
                                <a href="#" class="forgot-password">Forgot password?</a>
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" class="submit-btn">
                                <span class="btn-text">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    Access Dashboard
                                </span>
                                <div class="btn-loader">
                                    <div class="loader-spinner"></div>
                                </div>
                            </button>
                            
                            <!-- Two-Factor Notice -->
                            <div class="security-notice">
                                <div class="notice-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="notice-content">
                                    <strong>Enterprise Security Enabled</strong>
                                    <p>Your account is protected with bank-level encryption and monitoring</p>
                                </div>
                            </div>
                            
                            <!-- Register Section -->
                            <div class="register-section">
                                <p>Don't have a company account?</p>
                                <a href="{{ route('register.company') }}" class="register-link">
                                    Create Company Account
                                    <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                            
                            <!-- Divider -->
                            <div class="form-divider">
                                <span>Other options</span>
                            </div>
                            
                            <!-- Alternative Actions -->
                            <div class="alternative-actions">
                                <a href="{{ route('login.applicant') }}" class="alt-action">
                                    <div class="action-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="action-content">
                                        <span class="action-title">Job Seeker Login</span>
                                        <span class="action-desc">Looking for jobs instead?</span>
                                    </div>
                                </a>
                                <button type="button" class="alt-action" onclick="showSupportModal()">
                                    <div class="action-icon">
                                        <i class="fas fa-headset"></i>
                                    </div>
                                    <div class="action-content">
                                        <span class="action-title">Get Support</span>
                                        <span class="action-desc">Need help signing in?</span>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Support Modal -->
<div class="support-modal" id="supportModal">
    <div class="modal-backdrop"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3>Get Support</h3>
            <button type="button" class="modal-close" onclick="hideSupportModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="support-options">
                <a href="mailto:support@jobmatch.com" class="support-option">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <strong>Email Support</strong>
                        <p>support@jobmatch.com</p>
                    </div>
                </a>
                <a href="tel:+6221-1234-5678" class="support-option">
                    <i class="fas fa-phone"></i>
                    <div>
                        <strong>Phone Support</strong>
                        <p>+62-21-1234-5678</p>
                    </div>
                </a>
                <a href="#" class="support-option">
                    <i class="fas fa-comments"></i>
                    <div>
                        <strong>Live Chat</strong>
                        <p>Available 9 AM - 6 PM WIB</p>
                    </div>
                </a>
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
    :root {
        --primary: #4f46e5;
        --primary-dark: #3730a3;
        --primary-light: #818cf8;
        --secondary: #06b6d4;
        --success: #10b981;
        --warning: #f59e0b;
        --error: #ef4444;
        --dark: #0f172a;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --white: #ffffff;
        --radius: 12px;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        line-height: 1.6;
        color: var(--gray-900);
        overflow-x: hidden;
    }

    /* Layout */
    .ultimate-login-wrapper {
        min-height: 100vh;
        position: relative;
    }

    /* Animated Background */
    .animated-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--primary-dark) 100%);
    }

    .gradient-orbs {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .orb {
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.05));
        backdrop-filter: blur(2px);
        animation: float 20s infinite ease-in-out;
    }

    .orb-1 {
        width: 400px;
        height: 400px;
        top: -200px;
        left: -200px;
        animation-delay: 0s;
    }

    .orb-2 {
        width: 300px;
        height: 300px;
        top: 50%;
        right: -150px;
        animation-delay: -7s;
    }

    .orb-3 {
        width: 200px;
        height: 200px;
        bottom: -100px;
        left: 20%;
        animation-delay: -14s;
    }

    .orb-4 {
        width: 150px;
        height: 150px;
        top: 20%;
        left: 60%;
        animation-delay: -10s;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(50px, -50px) rotate(90deg); }
        50% { transform: translate(-30px, 40px) rotate(180deg); }
        75% { transform: translate(40px, 30px) rotate(270deg); }
    }

    /* Brand Panel */
    .brand-panel {
        background: transparent;
        position: relative;
        z-index: 2;
    }

    .brand-showcase {
        height: 100vh;
        display: flex;
        flex-direction: column;
        padding: 2rem;
        color: white;
    }

    /* Brand Navigation */
    .brand-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3rem;
    }

    .brand-logo .logo-container {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .logo-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .logo-text h3 {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 0;
    }

    .logo-text span {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .back-to-site {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: var(--radius);
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .back-to-site:hover {
        color: white;
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(-5px);
    }

    /* Showcase Content */
    .showcase-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        max-width: 600px;
    }

    .hero-section {
        margin-bottom: 3rem;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        padding: 0.5rem 1.25rem;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 2rem;
        backdrop-filter: blur(10px);
    }

    .hero-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        letter-spacing: -0.02em;
    }

    .gradient-text {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-description {
        font-size: 1.2rem;
        opacity: 0.9;
        line-height: 1.6;
        max-width: 500px;
    }

    /* Interactive Features */
    .features-interactive {
        margin-bottom: 3rem;
    }

    .feature-card {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem;
        margin-bottom: 1rem;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--radius);
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .feature-card:hover,
    .feature-card.active {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateX(10px);
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .feature-content {
        flex: 1;
    }

    .feature-content h4 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .feature-content p {
        opacity: 0.8;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }

    .feature-metric {
        display: flex;
        align-items: baseline;
        gap: 0.5rem;
    }

    .metric-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: #fbbf24;
    }

    .metric-label {
        font-size: 0.8rem;
        opacity: 0.7;
    }

    /* Success Stories */
    .success-stories {
        margin-top: auto;
    }

    .success-stories h3 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        opacity: 0.9;
    }

    .company-logos {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .company-logo {
        width: 60px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
    }

    .logo-placeholder {
        font-size: 0.7rem;
        font-weight: 700;
        opacity: 0.8;
    }

    /* Login Panel */
    .login-panel {
        background: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 2;
    }

    .login-container {
        width: 100%;
        max-width: 480px;
        padding: 2rem;
    }

    /* Mobile Header */
    .mobile-header {
        text-align: center;
        margin-bottom: 2rem;
        padding: 2rem 0;
    }

    .mobile-logo {
        width: 60px;
        height: 60px;
        background: var(--primary);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        color: white;
    }

    .mobile-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }

    .mobile-header p {
        color: var(--gray-600);
    }

    /* Login Card */
    .ultimate-login-card {
        background: var(--white);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: var(--shadow-xl);
        border: 1px solid var(--gray-100);
        position: relative;
        overflow: hidden;
    }

    .ultimate-login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
    }

    /* Card Header */
    .card-header {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 2rem;
        position: relative;
    }

    .header-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
        box-shadow: var(--shadow);
    }

    .header-content {
        flex: 1;
    }

    .header-content h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }

    .header-content p {
        color: var(--gray-600);
        margin: 0;
    }

    .security-badge {
        position: absolute;
        top: 0;
        right: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
        padding: 0.5rem 0.75rem;
        border-radius: var(--radius);
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    /* Form Styles */
    .ultimate-form {
        position: relative;
    }

    .form-field {
        margin-bottom: 1.5rem;
    }

    .field-label {
        display: block;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .input-container {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
        z-index: 2;
        transition: color 0.3s ease;
    }

    .field-input {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 2px solid var(--gray-200);
        border-radius: var(--radius);
        font-size: 1rem;
        font-weight: 500;
        background: var(--white);
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .field-input::placeholder {
        color: var(--gray-400);
        font-weight: 400;
    }

    .field-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .field-input:focus + .password-reveal,
    .field-input:focus ~ .input-icon {
        color: var(--primary);
    }

    .password-reveal {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--gray-400);
        cursor: pointer;
        padding: 0.5rem;
        z-index: 2;
        transition: color 0.3s ease;
    }

    .password-reveal:hover {
        color: var(--primary);
    }

    .input-highlight {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 2px;
        width: 0;
        background: var(--primary);
        transition: width 0.3s ease;
        border-radius: 1px;
    }

    .field-input:focus ~ .input-highlight {
        width: 100%;
    }

    .field-error {
        margin-top: 0.5rem;
        font-size: 0.8rem;
        color: var(--error);
        font-weight: 500;
        display: none;
    }

    .field-input.error {
        border-color: var(--error);
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .field-input.error ~ .field-error {
        display: block;
    }

    /* Form Options */
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
    }

    .custom-checkbox {
        display: none;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
        user-select: none;
    }

    .checkbox-indicator {
        width: 20px;
        height: 20px;
        border: 2px solid var(--gray-300);
        border-radius: 4px;
        position: relative;
        transition: all 0.3s ease;
        background: var(--white);
    }

    .checkbox-indicator::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-weight: 700;
        font-size: 0.8rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .custom-checkbox:checked + .checkbox-label .checkbox-indicator {
        background: var(--primary);
        border-color: var(--primary);
    }

    .custom-checkbox:checked + .checkbox-label .checkbox-indicator::after {
        opacity: 1;
    }

    .checkbox-text {
        font-weight: 500;
        color: var(--gray-700);
    }

    .forgot-password {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .forgot-password:hover {
        color: var(--primary-dark);
    }

    /* Submit Button */
    .submit-btn {
        width: 100%;
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        border: none;
        border-radius: var(--radius);
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow);
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    .btn-text {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.3s ease;
    }

    .btn-loader {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .loader-spinner {
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .submit-btn.loading .btn-text {
        opacity: 0;
    }

    .submit-btn.loading .btn-loader {
        opacity: 1;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Security Notice */
    .security-notice {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
        background: rgba(16, 185, 129, 0.05);
        border: 1px solid rgba(16, 185, 129, 0.2);
        border-radius: var(--radius);
        margin-bottom: 1.5rem;
    }

    .notice-icon {
        color: var(--success);
        font-size: 1.2rem;
        margin-top: 0.2rem;
    }

    .notice-content strong {
        display: block;
        color: var(--gray-900);
        font-weight: 600;
        margin-bottom: 0.25rem;
        font-size: 0.9rem;
    }

    .notice-content p {
        color: var(--gray-600);
        font-size: 0.85rem;
        margin: 0;
        line-height: 1.4;
    }

    /* Register Section */
    .register-section {
        text-align: center;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: var(--gray-50);
        border-radius: var(--radius);
        border: 1px solid var(--gray-100);
    }

    .register-section p {
        color: var(--gray-600);
        margin: 0 0 0.5rem 0;
        font-size: 0.9rem;
    }

    .register-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .register-link:hover {
        color: var(--primary-dark);
        transform: translateX(5px);
    }

    /* Form Divider */
    .form-divider {
        position: relative;
        text-align: center;
        margin: 2rem 0;
    }

    .form-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: var(--gray-200);
    }

    .form-divider span {
        background: var(--white);
        padding: 0 1rem;
        color: var(--gray-500);
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Alternative Actions */
    .alternative-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .alt-action {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        border: 2px solid var(--gray-200);
        border-radius: var(--radius);
        background: var(--white);
        color: var(--gray-700);
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .alt-action:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .action-icon {
        width: 40px;
        height: 40px;
        background: var(--gray-100);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .alt-action:hover .action-icon {
        background: rgba(79, 70, 229, 0.1);
        color: var(--primary);
    }

    .action-content {
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .action-title {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    .action-desc {
        font-size: 0.8rem;
        color: var(--gray-500);
    }

    /* Support Modal */
    .support-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
    }

    .support-modal.active {
        display: flex;
    }

    .modal-backdrop {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
    }

    .modal-content {
        background: var(--white);
        border-radius: 16px;
        width: 90%;
        max-width: 400px;
        position: relative;
        z-index: 2;
        box-shadow: var(--shadow-xl);
        animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-100);
    }

    .modal-header h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--gray-900);
    }

    .modal-close {
        background: none;
        border: none;
        color: var(--gray-400);
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .modal-close:hover {
        background: var(--gray-100);
        color: var(--gray-600);
    }

    .modal-body {
        padding: 1.5rem;
    }

    .support-options {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .support-option {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius);
        text-decoration: none;
        color: var(--gray-700);
        transition: all 0.3s ease;
    }

    .support-option:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: rgba(79, 70, 229, 0.05);
    }

    .support-option i {
        font-size: 1.2rem;
        width: 24px;
        text-align: center;
    }

    .support-option strong {
        display: block;
        margin-bottom: 0.25rem;
        font-weight: 600;
    }

    .support-option p {
        font-size: 0.9rem;
        color: var(--gray-500);
        margin: 0;
    }

    /* Responsive Design */
    @media (max-width: 1199.98px) {
        .brand-panel {
            display: none !important;
        }
        
        .login-panel {
            width: 100% !important;
            flex: none !important;
        }
        
        .ultimate-login-wrapper {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--primary-dark) 100%);
        }
        
        .login-panel {
            background: transparent;
        }
        
        .ultimate-login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    }

    @media (max-width: 576px) {
        .login-container {
            padding: 1rem;
        }
        
        .ultimate-login-card {
            padding: 2rem 1.5rem;
        }
        
        .form-options {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .alternative-actions {
            grid-template-columns: 1fr;
        }
        
        .hero-title {
            font-size: 2.5rem;
        }
    }

    /* Form Validation States */
    .field-input.valid {
        border-color: var(--success);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .field-input.valid ~ .input-icon {
        color: var(--success);
    }

    /* Loading States */
    .form-field.loading {
        opacity: 0.6;
        pointer-events: none;
    }

    /* Focus States */
    .field-input:focus ~ .input-icon,
    .field-input.has-value ~ .input-icon {
        color: var(--primary);
    }

    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    /* High contrast mode */
    @media (prefers-contrast: high) {
        .field-input {
            border-width: 3px;
        }
        
        .submit-btn {
            border: 2px solid var(--white);
        }
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form elements
    const form = document.querySelector('.ultimate-form');
    const emailInput = document.querySelector('#email');
    const passwordInput = document.querySelector('#password');
    const submitBtn = document.querySelector('.submit-btn');
    const passwordReveal = document.querySelector('.password-reveal');
    
    // Email validation
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    // Password validation
    function validatePassword(password) {
        return password.length >= 6;
    }
    
    // Show field error
    function showFieldError(input, message) {
        input.classList.add('error');
        input.classList.remove('valid');
        const errorElement = input.parentElement.querySelector('.field-error');
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }
    
    // Show field success
    function showFieldSuccess(input) {
        input.classList.remove('error');
        input.classList.add('valid');
        const errorElement = input.parentElement.querySelector('.field-error');
        errorElement.style.display = 'none';
    }
    
    // Clear field validation
    function clearFieldValidation(input) {
        input.classList.remove('error', 'valid');
        const errorElement = input.parentElement.querySelector('.field-error');
        errorElement.style.display = 'none';
    }
    
    // Email input validation
    emailInput.addEventListener('blur', function() {
        if (this.value.trim() === '') {
            clearFieldValidation(this);
        } else if (!validateEmail(this.value)) {
            showFieldError(this, 'Please enter a valid email address');
        } else {
            showFieldSuccess(this);
        }
    });
    
    emailInput.addEventListener('input', function() {
        if (this.classList.contains('error') && validateEmail(this.value)) {
            showFieldSuccess(this);
        }
    });
    
    // Password input validation
    passwordInput.addEventListener('blur', function() {
        if (this.value.trim() === '') {
            clearFieldValidation(this);
        } else if (!validatePassword(this.value)) {
            showFieldError(this, 'Password must be at least 6 characters long');
        } else {
            showFieldSuccess(this);
        }
    });
    
    passwordInput.addEventListener('input', function() {
        if (this.classList.contains('error') && validatePassword(this.value)) {
            showFieldSuccess(this);
        }
    });
    
    // Password reveal toggle
    passwordReveal.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        
        // Validate email
        if (!emailInput.value.trim()) {
            showFieldError(emailInput, 'Email is required');
            isValid = false;
        } else if (!validateEmail(emailInput.value)) {
            showFieldError(emailInput, 'Please enter a valid email address');
            isValid = false;
        }
        
        // Validate password
        if (!passwordInput.value.trim()) {
            showFieldError(passwordInput, 'Password is required');
            isValid = false;
        } else if (!validatePassword(passwordInput.value)) {
            showFieldError(passwordInput, 'Password must be at least 6 characters long');
            isValid = false;
        }
        
        if (isValid) {
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;

            fetch("{{ route('company.login.post') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    email: emailInput.value,
                    password: passwordInput.value
                })
            })
            .then(response => {
                if (!response.ok) throw new Error("Login gagal");
                return response.json();
            })
            .then(data => {
                showSuccessMessage("Login successful! Redirecting to dashboard...");
                setTimeout(() => {
                    window.location.href = "{{ route('company.dashboard') }}";
                }, 1500);
            })
            .catch(error => {
                console.error("Login failed", error);
                showFieldError(passwordInput, "Email atau password salah");
            })
            .finally(() => {
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
            });
        }
        } else {
            // Focus first invalid field
            const firstInvalid = form.querySelector('.field-input.error');
            if (firstInvalid) {
                firstInvalid.focus();
            }
        }
    });
    
    // Success message
    function showSuccessMessage(message) {
        const successDiv = document.createElement('div');
        successDiv.className = 'success-message';
        successDiv.innerHTML = `
            <div class="success-content">
                <i class="fas fa-check-circle"></i>
                <span>${message}</span>
            </div>
        `;
        
        // Add styles
        successDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--success);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            z-index: 1001;
            animation: slideInRight 0.3s ease-out;
        `;
        
        document.body.appendChild(successDiv);
        
        setTimeout(() => {
            successDiv.remove();
        }, 3000);
    }
    
    // Feature card interactions
    document.querySelectorAll('.feature-card').forEach(card => {
        card.addEventListener('click', function() {
            document.querySelectorAll('.feature-card').forEach(c => c.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Input focus effects
    document.querySelectorAll('.field-input').forEach(input => {
        input.addEventListener('focus', function() {
            this.classList.add('has-value');
        });
        
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.remove('has-value');
            }
        });
        
        input.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.add('has-value');
            } else {
                this.classList.remove('has-value');
            }
        });
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + Enter to submit
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            form.dispatchEvent(new Event('submit'));
        }
        
        // Alt + E for email
        if (e.altKey && e.key === 'e') {
            e.preventDefault();
            emailInput.focus();
        }
        
        // Alt + P for password
        if (e.altKey && e.key === 'p') {
            e.preventDefault();
            passwordInput.focus();
        }
        
        // Escape to clear focus
        if (e.key === 'Escape') {
            document.activeElement.blur();
        }
    });
    
    // Auto-focus first input on desktop
    if (window.innerWidth > 768) {
        setTimeout(() => {
            emailInput.focus();
        }, 500);
    }
    
    // Add ripple effect to submit button
    submitBtn.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.cssText = `
            position: absolute;
            left: ${x}px;
            top: ${y}px;
            width: ${size}px;
            height: ${size}px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        `;
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
    
    // Add ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
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
        
        .submit-btn {
            position: relative;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
    
    console.log('Ultimate company login initialized successfully!');
});

// Support Modal Functions
function showSupportModal() {
    const modal = document.getElementById('supportModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function hideSupportModal() {
    const modal = document.getElementById('supportModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

// Close modal on backdrop click
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-backdrop')) {
        hideSupportModal();
    }
});

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideSupportModal();
    }
});
</script>
@endsection