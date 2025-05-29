@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6">
                <div class="hero-content">
                    <div class="hero-badge mb-4">
                        <span class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill">
                            <i class="fas fa-rocket me-2"></i>Find Your Dream Job
                        </span>
                    </div>
                    
                    <h1 class="hero-title display-2 fw-bold mb-4">
                        <span class="text-primary">MATCH</span><br>
                        <span class="text-dark">WORK</span><br>
                        <span class="text-gradient">GROW</span>
                    </h1>
                    
                    <p class="hero-subtitle fs-5 text-muted mb-5 lh-lg">
                        Discover opportunities that align with your skills and aspirations. 
                        Connect with top companies and take the next step in your career journey.
                    </p>
                    
                    <div class="hero-buttons d-flex flex-wrap gap-3 mb-5">
                        <a href="{{ route('register.applicant') }}" class="btn btn-primary btn-lg px-4 py-3 rounded-pill shadow-sm">
                            <i class="fas fa-user-plus me-2"></i>Sign Up
                        </a>
                        <a href="{{ route('login.applicant') }}" class="btn btn-outline-primary btn-lg px-4 py-3 rounded-pill">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="hero-stats d-flex flex-wrap gap-4">
                        <div class="stat-item">
                            <h3 class="stat-number text-primary fw-bold mb-0">10K+</h3>
                            <p class="stat-label text-muted small mb-0">Active Jobs</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number text-primary fw-bold mb-0">5K+</h3>
                            <p class="stat-label text-muted small mb-0">Companies</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number text-primary fw-bold mb-0">50K+</h3>
                            <p class="stat-label text-muted small mb-0">Job Seekers</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="hero-image-section position-relative">
                    <!-- Main Hero Image
                    <div class="main-hero-image text-center mb-4">
                        <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                             alt="Professional team working" 
                             class="img-fluid rounded-4 shadow-lg main-image"> -->
                        
                        <!-- Overlay Stats Card -->
                        <div class="stats-overlay card position-absolute shadow-lg border-0 rounded-3">
                            <div class="card-body p-2 text-center">
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <i class="fas fa-chart-line text-success me-1"></i>
                                    <span class="fw-bold text-success small">+250%</span>
                                </div>
                                <small class="text-muted" style="font-size: 0.7rem;">Match Rate</small>
                            </div>
                        </div>
                    </div>

         <div class="floating-cards">
                        <!-- Job Card 1 -->
                        <div class="job-card floating-card-1">
                            <div class="card shadow-lg border-0 rounded-3">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="company-icon rounded-circle me-3">
                                            <i class="fas fa-laptop fa-2x"></i>
                                        </div>
                                        <div>
                                            <h6 class="card-title mb-0 fw-bold">Frontend Developer</h6>
                                            <small class="text-muted">Tech Innovate</small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-success-soft text-success">
                                            <i class="fas fa-home me-1"></i>Remote
                                        </span>
                                        <small class="text-muted fw-bold">$80k - $120k</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Job Card 2 -->
                        <div class="job-card floating-card-2">
                            <div class="card shadow-lg border-0 rounded-3">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="company-icon rounded-circle me-3">
                                            <i class="fas fa-chart-bar fa-2x"></i>
                                        </div>
                                        <div>
                                            <h6 class="card-title mb-0 fw-bold">Data Analyst</h6>
                                            <small class="text-muted">Analytics Pro</small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary-soft text-primary">
                                            <i class="fas fa-building me-1"></i>Full-time
                                        </span>
                                        <small class="text-muted fw-bold">$70k - $100k</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Job Card 3 -->
                        <div class="job-card floating-card-3">
                            <div class="card shadow-lg border-0 rounded-3">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="company-icon rounded-circle me-3">
                                            <i class="fas fa-paint-brush fa-2x"></i>
                                        </div>
                                        <div>
                                            <h6 class="card-title mb-0 fw-bold">UI/UX Designer</h6>
                                            <small class="text-muted">Creative Studios</small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-warning-soft text-warning">
                                            <i class="fas fa-clock me-1"></i>Contract
                                        </span>
                                        <small class="text-muted fw-bold">$60k - $90k</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional floating elements -->
                        <div class="floating-element element-1">
                            <div class="floating-icon bg-primary-soft text-primary rounded-circle p-3 shadow">
                                <i class="fas fa-rocket fa-lg"></i>
                            </div>
                        </div>
                        
                        <div class="floating-element element-2">
                            <div class="floating-icon bg-success-soft text-success rounded-circle p-3 shadow">
                                <i class="fas fa-trophy fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="display-5 fw-bold mb-3">Why Choose JobMatch?</h2>
                <p class="lead text-muted">Discover what makes us the perfect platform for your career journey</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-body text-center p-4">
                        <div class="feature-image mb-3">
                            <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=250&q=80" 
                                 alt="Smart Job Matching" class="img-fluid rounded-3 mb-2" style="height: 150px; width: 100%; object-fit: cover;">
                        </div>
                        <div class="feature-icon bg-primary-soft rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-search-plus text-primary fa-lg"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-3">Smart Job Matching</h5>
                        <p class="card-text text-muted">Our AI-powered algorithm matches you with jobs that perfectly align with your skills and preferences.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-card card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-body text-center p-4">
                        <div class="feature-image mb-3">
                            <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=250&q=80" 
                                 alt="Trusted Companies" class="img-fluid rounded-3 mb-2" style="height: 150px; width: 100%; object-fit: cover;">
                        </div>
                        <div class="feature-icon bg-success-soft rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-handshake text-success fa-lg"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-3">Trusted Companies</h5>
                        <p class="card-text text-muted">Connect with verified companies and startups that are actively looking for talented professionals.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-card card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-body text-center p-4">
                        <div class="feature-image mb-3">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=250&q=80" 
                                 alt="Career Growth" class="img-fluid rounded-3 mb-2" style="height: 150px; width: 100%; object-fit: cover;">
                        </div>
                        <div class="feature-icon bg-warning-soft rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-rocket text-warning fa-lg"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-3">Career Growth</h5>
                        <p class="card-text text-muted">Access resources, tips, and opportunities that help you advance your career to the next level.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 position-relative overflow-hidden bg-dark text-white">
    <div class="cta-background"></div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="cta-content">
                    <h2 class="display-6 fw-bold mb-3">✨ Ready to Find Your Dream Job? ✨</h2>
                    <p class="fs-5 mb-4 opacity-90">Join thousands of professionals who have already found their perfect match.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('login.applicant') }}" class="btn btn-light btn-lg px-4 py-3 rounded-pill shadow">
                            <i class="fas fa-user-plus me-2"></i>Start Find A Job!
                        </a>
                        <a href="{{ route('CompanyHome') }}" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                            <i class="fas fa-building me-2"></i>For Companies
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="cta-icons-grid text-center">
                    <!-- Icon Grid for Key Features -->
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="cta-icon-card bg-opacity-10 rounded-3 p-4 text-center">
                                <i class="fas fa-users fa-2x text-light mb-2"></i>
                                <p class="small mb-0">👥 50K+ Active Users</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="cta-icon-card bg-opacity-10 rounded-3 p-4 text-center">
                                <i class="fas fa-briefcase fa-2x text-light mb-2"></i>
                                <p class="small mb-0">📄 10K+ Job Listings</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="cta-icon-card bg-opacity-10 rounded-3 p-4 text-center">
                                <i class="fas fa-handshake fa-2x text-light mb-2"></i>
                                <p class="small mb-0">🌟 5K+ Success Stories</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="cta-icon-card bg-opacity-10 rounded-3 p-4 text-center">
                                <i class="fas fa-star fa-2x text-light mb-2"></i>
                                <p class="small mb-0">⭐ 4.9/5 Rating</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Testimonials Section -->
<section class="testimonials-section py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="display-5 fw-bold mb-3">What Our Users Say</h2>
                <p class="lead text-muted">Real stories from real people who found their dream jobs</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 text-center">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                             alt="Sarah Johnson" class="testimonial-avatar rounded-circle mb-3">
                        <div class="testimonial-stars mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text text-muted mb-3">"JobMatch helped me find my dream job in tech. The matching algorithm is incredibly accurate!"</p>
                        <h6 class="card-title fw-bold mb-1">Sarah Johnson</h6>
                        <small class="text-muted">Software Developer at TechCorp</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 text-center">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                             alt="Michael Chen" class="testimonial-avatar rounded-circle mb-3">
                        <div class="testimonial-stars mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text text-muted mb-3">"As a recruiter, JobMatch has revolutionized how we find qualified candidates. Highly recommended!"</p>
                        <h6 class="card-title fw-bold mb-1">Michael Chen</h6>
                        <small class="text-muted">HR Manager at InnovateLab</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 text-center">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                             alt="Emily Rodriguez" class="testimonial-avatar rounded-circle mb-3">
                        <div class="testimonial-stars mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text text-muted mb-3">"The platform is user-friendly and the job recommendations are spot on. Found my perfect role in weeks!"</p>
                        <h6 class="card-title fw-bold mb-1">Emily Rodriguez</h6>
                        <small class="text-muted">Marketing Director at CreativeHub</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    :root {
        --primary-color: #4f46e5;
        --primary-light: #f0f0ff;
        --success-color: #10b981;
        --success-light: #f0fdf4;
        --warning-color: #f59e0b;
        --warning-light: #fffbeb;
        --info-color: #06b6d4;
        --info-light: #f0fdfa;
    }

    body {
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        line-height: 1.6;
    }

    .hero-section {
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.9) 0%, rgba(6, 182, 212, 0.9) 100%),
                    url('https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.1);
        z-index: 1;
    }

    .hero-section .container {
        position: relative;
        z-index: 2;
    }

    .main-image {
        max-height: 250px;
        object-fit: cover;
        width: 100%;
        max-width: 350px;
    }

    .hero-image-section {
        max-width: 400px;
        margin: 0 auto;
    }

    .stats-overlay {
        bottom: 10px;
        right: 10px;
        min-width: 100px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }

    .company-avatar {
        width: 30px;
        height: 30px;
        object-fit: cover;
    }

    .floating-element {
        position: absolute;
        animation: float 4s ease-in-out infinite;
    }

    .element-1 {
        top: 60px;
        left: 20px;
        animation-delay: 1s;
    }

    .element-2 {
        bottom: 100px;
        left: 60px;
        animation-delay: 3s;
    }

    .floating-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .job-card {
        position: absolute;
        width: 220px;
        animation: float 6s ease-in-out infinite;
    }

    .floating-card-1 {
        top: 40px;
        right: 60px;
        animation-delay: 0s;
    }

    .floating-card-2 {
        top: 160px;
        right: 180px;
        animation-delay: 2s;
    }

    .floating-card-3 {
        top: 280px;
        right: 30px;
        animation-delay: 4s;
    }

    .feature-icon {
        width: 60px;
        height: 60px;
    }

    .cta-icon-card {
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .cta-icon-card:hover {
        background: rgba(255, 255, 255, 0.2) !important;
        transform: translateY(-5px);
    }

    .cta-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, #06b6d4 100%);
    }

    .cta-background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        opacity: 0.1;
    }

    .testimonial-avatar {
        width: 80px;
        height: 80px;
        object-fit: cover;
    }

    .testimonial-stars {
        font-size: 1.2rem;
    }

    .feature-image img {
        transition: transform 0.3s ease;
    }

    .feature-card:hover .feature-image img {
        transform: scale(1.05);
    }

    .text-gradient {
        background: linear-gradient(135deg, var(--primary-color) 0%, #06b6d4 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .bg-primary-soft {
        background-color: var(--primary-light) !important;
    }

    .bg-success-soft {
        background-color: var(--success-light) !important;
    }

    .bg-warning-soft {
        background-color: var(--warning-light) !important;
    }

    .bg-info-soft {
        background-color: var(--info-light) !important;
    }

    .text-primary { color: var(--primary-color) !important; }
    .text-success { color: var(--success-color) !important; }
    .text-warning { color: var(--warning-color) !important; }
    .text-info { color: var(--info-color) !important; }

    .hero-title {
        line-height: 1.1;
        letter-spacing: -0.02em;
    }

    .btn {
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .floating-cards {
        position: relative;
        height: 500px;
    }

    .job-card {
        position: absolute;
        width: 280px;
        animation: float 6s ease-in-out infinite;
    }

    .floating-card-1 {
        top: 50px;
        right: 100px;
        animation-delay: 0s;
    }

    .floating-card-2 {
        top: 200px;
        right: 250px;
        animation-delay: 2s;
    }

    .floating-card-3 {
        top: 350px;
        right: 50px;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .company-logo {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .feature-icon {
        width: 80px;
        height: 80px;
    }

    .feature-card {
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, #06b6d4 100%);
    }

    .cta-card {
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 2rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 3rem;
        }
        
        .floating-cards,
        .floating-element {
            display: none;
        }
        
        .main-hero-image {
            margin-bottom: 2rem;
        }
        
        .hero-buttons {
            justify-content: center;
        }
        
        .hero-stats {
            justify-content: center;
            text-align: center;
        }
        
        .cta-content {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .feature-image {
            margin-bottom: 1rem;
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-section {
            padding: 2rem 0;
        }
        
        .btn-lg {
            font-size: 1rem;
            padding: 0.75rem 1.5rem;
        }
    }

    /* Additional animations */
    .hero-content {
        animation: fadeInUp 1s ease-out;
    }

    .feature-card {
        animation: fadeInUp 1s ease-out;
    }

    .feature-card:nth-child(1) { animation-delay: 0.2s; }
    .feature-card:nth-child(2) { animation-delay: 0.4s; }
    .feature-card:nth-child(3) { animation-delay: 0.6s; }

    @keyframes fadeInUp {
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