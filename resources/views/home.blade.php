@extends('layouts.app')

@section('content')
<!-- Hero Section for Job Seekers -->
<section class="position-relative overflow-hidden min-vh-100 d-flex align-items-center hero-section">
    
    <!-- Background Image with Overlay -->
    <div class="position-absolute w-100 h-100" style="z-index: 1;">
        <div class="position-absolute w-100 h-100" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.85) 0%, rgba(30, 41, 59, 0.8) 50%, rgba(51, 65, 85, 0.75) 100%);"></div>
        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" 
             class="w-100 h-100 object-fit-cover" alt="Team collaboration">
    </div>
    <!-- Geometric Shapes -->
    <div class="position-absolute w-100 h-100 overflow-hidden" style="z-index: 2;">
        <div class="geometric-shape shape-1"></div>
        <div class="geometric-shape shape-2"></div>
        <div class="geometric-shape shape-3"></div>
        <div class="geometric-shape shape-4"></div>
        <div class="geometric-shape shape-5"></div>
        <div class="geometric-shape shape-6"></div>
    </div>
    
    <div class="container-fluid position-relative" style="z-index: 10;">
        <div class="row g-0 align-items-center min-vh-100">
            <div class="col-lg-6 order-lg-1 order-2">
                <div class="p-5">
                    <!-- Enhanced Badge -->
                    <div class="badge-container mb-4">
                        <span class="badge bg-gradient-primary text-white px-4 py-3 rounded-pill fw-bold fs-6 shadow-lg animated-badge">
                            <i class="fas fa-rocket me-2 pulse-icon"></i>Find Your Dream Job
                        </span>
                    </div>
                    
                    <!-- Animated Title -->
                    <h1 class="display-1 fw-bold mb-4 lh-1 animated-title">
                        <span class="text-warning glow-text">FIND</span><br>
                        <span class="text-white">YOUR</span><br>
                        <span class="text-info glow-text">CAREER</span>
                    </h1>
                    
                    <!-- Enhanced Description -->
                    <p class="fs-4 text-white-50 mb-5 lh-base animated-description">
                        Discover opportunities that align with your skills and aspirations. Connect with top companies and accelerate your career growth journey with AI-powered matching.
                    </p>
                    
                    <!-- Enhanced Buttons -->
                    <div class="mb-5 button-group">
                        <a href="{{ route('register.applicant') }}" class="btn btn-warning btn-lg me-3 mb-3 px-5 py-3 fw-bold rounded-pill shadow-lg hover-lift-lg animated-btn">
                            <i class="fas fa-user-plus me-2"></i>Start Job Search
                            <span class="btn-shine"></span>
                        </a>
                        <a href="{{ route('login.applicant') }}" class="btn btn-outline-light btn-lg mb-3 px-5 py-3 fw-bold rounded-pill hover-lift-lg glass-btn">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    </div>
                    
                    <!-- Enhanced Benefits -->
                    <div class="row g-3 benefits-grid">
                        <div class="col-md-4">
                            <div class="benefit-card text-center p-4 rounded-4 hover-lift">
                                <div class="benefit-icon bg-success rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-brain text-white"></i>
                                </div>
                                <h6 class="fw-bold mb-2 text-white">Smart Matching</h6>
                                <small class="text-white-50">AI-Powered Jobs</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="benefit-card text-center p-4 rounded-4 hover-lift">
                                <div class="benefit-icon bg-info rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-building text-white"></i>
                                </div>
                                <h6 class="fw-bold mb-2 text-white">Top Companies</h6>
                                <small class="text-white-50">Verified Employers</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="benefit-card text-center p-4 rounded-4 hover-lift">
                                <div class="benefit-icon bg-warning rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-rocket text-dark"></i>
                                </div>
                                <h6 class="fw-bold mb-2 text-white">Career Growth</h6>
                                <small class="text-white-50">Fast Track</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 order-lg-2 order-1 d-flex align-items-center justify-content-center min-vh-100 position-relative" style="z-index: 5;">
                <!-- Enhanced Floating Achievement Cards -->
                <div class="position-absolute animate-notification d-none d-lg-block floating-card-1">
                    <div class="card border-0 shadow-2xl rounded-4 p-3 hover-scale glass-card">
                        <div class="d-flex align-items-center">
                            <div class="icon-container bg-success rounded-3 me-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-trophy text-white"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold text-dark">Achievement Unlocked!</h6>
                                <small class="text-muted">Sarah completed her profile</small>
                                <div class="progress mt-2 rounded-pill" style="height: 4px;">
                                    <div class="progress-bar bg-success progress-animated" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="position-absolute animate-notification d-none d-lg-block floating-card-2">
                    <div class="card border-0 shadow-2xl rounded-4 p-3 hover-scale glass-card">
                        <div class="d-flex align-items-center">
                            <div class="position-relative me-3 profile-container">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=45&h=45&fit=crop&crop=face" 
                                     class="rounded-circle profile-img" width="45" height="45">
                                <span class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-1 border border-white notification-badge">
                                    <i class="fas fa-calendar-check text-white" style="font-size: 8px;"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold text-dark">Interview Scheduled</h6>
                                <small class="text-muted">Alex • Google • Tomorrow 2PM</small>
                                <div class="mt-1">
                                    <span class="badge bg-primary bg-opacity-15 text-primary small rounded-pill">Remote</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="position-absolute animate-notification d-none d-lg-block floating-card-4">
                    <div class="card border-0 shadow-2xl rounded-4 p-3 hover-scale glass-card">
                        <div class="d-flex align-items-center">
                            <div class="icon-container bg-purple bg-opacity-20 rounded-3 me-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-handshake text-purple fa-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold text-dark">Job Offer!</h6>
                                <small class="text-muted">David got hired at Netflix</small>
                                <small class="text-success d-block fw-semibold">
                                    <i class="fas fa-circle pulse-green me-1" style="font-size: 6px;"></i>Just now
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Central Stats Display -->
                <div class="text-center main-card">
                    <div class="card border-0 shadow-2xl rounded-4 p-4 glass-card-main">
                        <div class="mb-4">
                            <div class="main-icon bg-gradient-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-briefcase text-white fa-2x"></i>
                            </div>
                            <h4 class="fw-bold text-white mb-1 glow-text">Job Opportunities</h4>
                            <small class="text-white-50">
                                <i class="fas fa-sync-alt me-1 rotate-icon"></i>Updated every hour
                            </small>
                        </div>
                        
                        <div class="row g-3 mb-4 stats-row">
                            <div class="col-4">
                                <div class="stat-item text-center p-2 rounded-3">
                                    <h5 class="fw-bold mb-0 text-warning counter glow-number" data-target="10">0</h5>
                                    <small class="text-white-50">Jobs</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item text-center p-2 rounded-3">
                                    <h5 class="fw-bold mb-0 text-info counter glow-number" data-target="5">0</h5>
                                    <small class="text-white-50">Companies</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item text-center p-2 rounded-3">
                                    <h5 class="fw-bold mb-0 text-success counter glow-number" data-target="95">0</h5>
                                    <small class="text-white-50">% Success</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-warning fw-bold rounded-pill py-3 hover-lift-lg explore-btn" onclick="openJobSearchDemo()">
                                <i class="fas fa-search me-2"></i>Explore Jobs
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Job Categories Section -->
<section class="py-5 categories-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary text-white px-4 py-3 rounded-pill mb-3 fs-6 shadow">
                <i class="fas fa-briefcase me-2"></i>Popular Categories
            </span>
            <h2 class="display-6 fw-bold mb-3">Explore Jobs by Category</h2>
            <p class="lead text-muted">Find opportunities in your field of expertise</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="category-card card border-0 shadow-lg h-100 text-center p-4 hover-lift-lg">
                    <div class="category-icon bg-primary bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                        <i class="fas fa-laptop-code text-primary fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Technology</h5>
                    <p class="text-muted mb-2">2,500+ Jobs Available</p>
                    <small class="text-primary fw-bold">Starting $60K+</small>
                    <div class="category-overlay"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="category-card card border-0 shadow-lg h-100 text-center p-4 hover-lift-lg">
                    <div class="category-icon bg-success bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                        <i class="fas fa-chart-line text-success fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Finance</h5>
                    <p class="text-muted mb-2">1,800+ Jobs Available</p>
                    <small class="text-success fw-bold">Starting $55K+</small>
                    <div class="category-overlay"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="category-card card border-0 shadow-lg h-100 text-center p-4 hover-lift-lg">
                    <div class="category-icon bg-warning bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                        <i class="fas fa-bullhorn text-warning fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Marketing</h5>
                    <p class="text-muted mb-2">1,200+ Jobs Available</p>
                    <small class="text-warning fw-bold">Starting $45K+</small>
                    <div class="category-overlay"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="category-card card border-0 shadow-lg h-100 text-center p-4 hover-lift-lg">
                    <div class="category-icon bg-info bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                        <i class="fas fa-paint-brush text-info fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Design</h5>
                    <p class="text-muted mb-2">900+ Jobs Available</p>
                    <small class="text-info fw-bold">Starting $50K+</small>
                    <div class="category-overlay"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Features Section -->
<section class="py-5 features-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-success text-white px-4 py-3 rounded-pill mb-3 fs-6 shadow">
                <i class="fas fa-star me-2"></i>Why JobMatch?
            </span>
            <h2 class="display-6 fw-bold mb-3">Your Career Success Partner</h2>
            <p class="lead text-muted">Everything you need to land your dream job</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="feature-card card border-0 shadow-lg h-100 p-4 hover-lift-lg">
                    <div class="text-center mb-4">
                        <div class="feature-icon bg-primary rounded-4 p-4 d-inline-block mb-3">
                            <i class="fas fa-brain text-white fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">AI Job Matching</h4>
                    </div>
                    <p class="text-muted mb-4">Smart algorithms match you with jobs that fit your skills, experience, and career goals perfectly.</p>
                    <ul class="list-unstyled feature-list">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Personalized recommendations</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Skill-based matching</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Career path suggestions</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="feature-card card border-0 shadow-lg h-100 p-4 hover-lift-lg">
                    <div class="text-center mb-4">
                        <div class="feature-icon bg-success rounded-4 p-4 d-inline-block mb-3">
                            <i class="fas fa-user-friends text-white fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Professional Network</h4>
                    </div>
                    <p class="text-muted mb-4">Connect with industry professionals, mentors, and recruiters to expand your career opportunities.</p>
                    <ul class="list-unstyled feature-list">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Industry connections</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Mentorship programs</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Professional events</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="feature-card card border-0 shadow-lg h-100 p-4 hover-lift-lg">
                    <div class="text-center mb-4">
                        <div class="feature-icon bg-warning rounded-4 p-4 d-inline-block mb-3">
                            <i class="fas fa-graduation-cap text-white fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Career Development</h4>
                    </div>
                    <p class="text-muted mb-4">Access courses, certifications, and resources to upskill and advance your career.</p>
                    <ul class="list-unstyled feature-list">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Online courses</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Industry certifications</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Resume optimization</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Success Stories Section -->
<section class="py-5 bg-light success-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-info text-white px-4 py-3 rounded-pill mb-3 fs-6 shadow">
                <i class="fas fa-quote-left me-2"></i>Success Stories
            </span>
            <h2 class="display-6 fw-bold mb-3">Career Transformations</h2>
            <p class="lead text-muted">Real stories from professionals who found their dream jobs</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="testimonial-card card border-0 shadow-lg h-100 hover-lift-lg">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="profile-wrapper me-3">
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b612b647?ixlib=rb-4.0.3&auto=format&fit=crop&w=60&q=80" 
                                     class="rounded-circle profile-img" width="60" height="60">
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Sarah Johnson</h6>
                                <small class="text-muted">Frontend Developer at Google</small>
                            </div>
                        </div>
                        <div class="mb-3 text-warning stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted testimonial-text">"JobMatch membantu saya menemukan pekerjaan impian di Google. Algoritma AI-nya sangat akurat dalam matching skills dengan kebutuhan perusahaan."</p>
                        <div class="d-flex justify-content-between">
                            <span class="badge bg-success rounded-pill">+150% Salary</span>
                            <span class="badge bg-primary rounded-pill">Remote Work</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="testimonial-card card border-0 shadow-lg h-100 hover-lift-lg">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="profile-wrapper me-3">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=60&q=80" 
                                     class="rounded-circle profile-img" width="60" height="60">
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Michael Chen</h6>
                                <small class="text-muted">Data Scientist at Microsoft</small>
                            </div>
                        </div>
                        <div class="mb-3 text-warning stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted testimonial-text">"Platform ini tidak hanya membantu saya mendapat pekerjaan, tapi juga memberikan guidance untuk pengembangan karir jangka panjang."</p>
                        <div class="d-flex justify-content-between">
                            <span class="badge bg-success rounded-pill">+200% Growth</span>
                            <span class="badge bg-info rounded-pill">Tech Giant</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="testimonial-card card border-0 shadow-lg h-100 hover-lift-lg">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="profile-wrapper me-3">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=60&q=80" 
                                     class="rounded-circle profile-img" width="60" height="60">
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Emily Rodriguez</h6>
                                <small class="text-muted">Product Manager at Shopify</small>
                            </div>
                        </div>
                        <div class="mb-3 text-warning stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted testimonial-text">"Dari junior designer menjadi Product Manager dalam 2 tahun. JobMatch memberikan roadmap yang jelas untuk career transition."</p>
                        <div class="d-flex justify-content-between">
                            <span class="badge bg-success rounded-pill">Career Switch</span>
                            <span class="badge bg-warning rounded-pill">Leadership</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced CTA Section -->
<section class="py-5 text-white position-relative overflow-hidden cta-section">
    <div class="position-absolute w-100 h-100" style="z-index: 1;">
        <div class="position-absolute w-100 h-100" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);"></div>
        <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" 
             class="w-100 h-100 object-fit-cover" alt="Success celebration">
    </div>
    
    <div class="container position-relative" style="z-index: 10;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-warning text-dark px-4 py-3 rounded-pill mb-3 fw-bold fs-6 shadow">
                    <i class="fas fa-rocket me-2"></i>Start Your Journey
                </span>
                <h2 class="display-5 fw-bold mb-3 glow-text">Ready to Find Your Dream Job?</h2>
                <p class="fs-5 mb-4 opacity-75">Join 50,000+ professionals who found their perfect career match. Your next opportunity is waiting.</p>
                <div class="cta-buttons">
                    <a href="{{ route('register.applicant') }}" class="btn btn-warning btn-lg me-3 mb-3 px-5 py-3 fw-bold rounded-pill shadow-lg hover-lift-lg animated-btn">
                        <i class="fas fa-user-plus me-2"></i>Create Free Profile
                        <span class="btn-shine"></span>
                    </a>
                    <button class="btn btn-outline-light btn-lg mb-3 px-5 py-3 fw-bold rounded-pill hover-lift-lg glass-btn" onclick="openJobSearchDemo()">
                        <i class="fas fa-search me-2"></i>Browse Jobs
                    </button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="text-center cta-stats">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="stat-card bg-white bg-opacity-15 rounded-4 p-4 hover-lift">
                                <i class="fas fa-briefcase fa-2x mb-2 text-warning"></i>
                                <h5 class="fw-bold mb-0 counter glow-number" data-target="10">0</h5>
                                <small>K+ Jobs</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card bg-white bg-opacity-15 rounded-4 p-4 hover-lift">
                                <i class="fas fa-users fa-2x mb-2 text-info"></i>
                                <h5 class="fw-bold mb-0">50K+</h5>
                                <small>Happy Users</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --glass-bg: rgba(255, 255, 255, 0.1);
        --glass-border: rgba(255, 255, 255, 0.2);
        --shadow-xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        --glow-color: rgba(255, 255, 255, 0.5);
    }

    /* Background Images */
    .object-fit-cover {
        object-fit: cover;
    }

    /* Enhanced Particles */
    .particle {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }

    .particle-1 { width: 100px; height: 100px; top: 15%; left: 5%; animation: float 20s ease-in-out infinite; }
    .particle-2 { width: 150px; height: 150px; top: 60%; right: 8%; animation: float 25s ease-in-out infinite reverse; }
    .particle-3 { width: 80px; height: 80px; top: 35%; right: 25%; animation: float 22s ease-in-out infinite; }
    .particle-4 { width: 120px; height: 120px; bottom: 25%; left: 15%; animation: float 18s ease-in-out infinite reverse; }
    .particle-5 { width: 60px; height: 60px; top: 25%; left: 30%; animation: float 24s ease-in-out infinite; }
    .particle-6 { width: 90px; height: 90px; bottom: 40%; right: 35%; animation: float 21s ease-in-out infinite reverse; }
    .particle-7 { width: 70px; height: 70px; top: 70%; left: 70%; animation: float 19s ease-in-out infinite; }
    .particle-8 { width: 110px; height: 110px; bottom: 60%; left: 40%; animation: float 23s ease-in-out infinite reverse; }

    /* Geometric Shapes */
    .geometric-shape {
        position: absolute;
        pointer-events: none;
        opacity: 0.1;
    }

    .shape-1 {
        width: 200px;
        height: 200px;
        border: 2px solid #fff;
        border-radius: 30px;
        top: 10%;
        right: 20%;
        animation: rotate 30s linear infinite;
    }

    .shape-2 {
        width: 150px;
        height: 150px;
        border: 2px solid #fbbf24;
        border-radius: 50%;
        bottom: 20%;
        left: 10%;
        animation: rotate 25s linear infinite reverse;
    }

    .shape-3 {
        width: 100px;
        height: 100px;
        border: 2px solid #06b6d4;
        transform: rotate(45deg);
        top: 50%;
        left: 80%;
        animation: float 20s ease-in-out infinite;
    }

    /* Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-20px) rotate(5deg); }
        66% { transform: translateY(-10px) rotate(-5deg); }
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    @keyframes shine {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    @keyframes glow {
        0%, 100% { text-shadow: 0 0 20px var(--glow-color); }
        50% { text-shadow: 0 0 30px var(--glow-color), 0 0 40px var(--glow-color); }
    }

    /* Enhanced Typography */
    .glow-text {
        animation: glow 3s ease-in-out infinite;
    }

    .glow-number {
        animation: glow 2s ease-in-out infinite;
    }

    .animated-title {
        animation: fadeInUp 1s ease-out;
    }

    .animated-description {
        animation: fadeInUp 1s ease-out 0.3s both;
    }

    .animated-badge {
        animation: fadeInDown 1s ease-out 0.1s both;
    }

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

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Enhanced Buttons */
    .animated-btn {
        position: relative;
        overflow: hidden;
        transform: perspective(1px) translateZ(0);
        transition: all 0.3s ease;
    }

    .btn-shine {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        animation: shine 2s infinite;
    }

    .glass-btn {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Enhanced Cards */
    .glass-card {
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .glass-card-main {
        backdrop-filter: blur(20px);
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
    }

    .shadow-2xl {
        box-shadow: var(--shadow-xl);
    }

    /* Enhanced Hover Effects */
    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }

    .hover-lift-lg {
        transition: all 0.4s ease;
    }

    .hover-lift-lg:hover {
        transform: translateY(-12px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.25);
    }

    .hover-scale {
        transition: all 0.3s ease;
    }

    .hover-scale:hover {
        transform: scale(1.05);
    }

    /* Enhanced Icons */
    .pulse-icon {
        animation: pulse 2s infinite;
    }

    .rotate-icon {
        animation: rotate 2s linear infinite;
    }

    .benefit-icon, .icon-container, .icon-large {
        width: 60px;
        height: 60px;
        transition: all 0.3s ease;
    }

    .benefit-icon:hover, .icon-container:hover {
        transform: scale(1.1);
    }

    .main-icon {
        width: 80px;
        height: 80px;
    }

    /* Floating Cards Positioning */
    .floating-card-1 { top: 8%; left: -15%; animation: floatNotification 10s ease-in-out infinite; }
    .floating-card-2 { top: 25%; right: -18%; animation: floatNotification 10s ease-in-out infinite 3s; }
    .floating-card-3 { bottom: 30%; left: -12%; animation: floatNotification 10s ease-in-out infinite 6s; }
    .floating-card-4 { bottom: 8%; right: -10%; animation: floatNotification 10s ease-in-out infinite 12s; }
    .floating-card-5 { top: 60%; right: -15%; animation: floatNotification 10s ease-in-out infinite 9s; }

    @keyframes floatNotification {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }

    /* Enhanced Category Cards */
    .category-card {
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .category-card:hover {
        transform: translateY(-15px);
    }

    .category-overlay {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        transition: all 0.6s ease;
    }

    .category-card:hover .category-overlay {
        left: 100%;
    }

    .category-icon {
        width: 90px;
        height: 90px;
        transition: all 0.3s ease;
    }

    .category-card:hover .category-icon {
        transform: scale(1.1);
    }

    /* Enhanced Feature Cards */
    .feature-card {
        transition: all 0.4s ease;
        border-radius: 16px;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .feature-icon {
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.05);
    }

    /* Enhanced Testimonial Cards */
    .testimonial-card {
        transition: all 0.4s ease;
        border-radius: 16px;
    }

    .testimonial-card:hover {
        transform: translateY(-8px);
    }

    .profile-wrapper {
        position: relative;
    }

    .profile-img {
        border: 3px solid #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .testimonial-card:hover .profile-img {
        transform: scale(1.05);
    }

    .stars {
        font-size: 1.2rem;
    }

    /* Enhanced Progress and Indicators */
    .progress-animated {
        animation: progressFill 2s ease-in-out;
    }

    @keyframes progressFill {
        from { width: 0%; }
        to { width: 100%; }
    }

    .company-dot {
        width: 8px;
        height: 8px;
        transition: all 0.3s ease;
    }

    .pulse-dot {
        animation: pulse 2s infinite;
    }

    .pulse-green {
        color: #10b981;
        animation: pulse 1s infinite;
    }

    .notification-badge {
        animation: pulse 2s infinite;
    }

    /* Background Patterns */
    .bg-purple {
        background-color: var(--bs-purple, #6f42c1) !important;
    }

    .text-purple {
        color: var(--bs-purple, #6f42c1) !important;
    }

    .bg-gradient-primary {
        background: var(--primary-gradient) !important;
    }

    /* Section Specific Styles */
    .hero-section {
        position: relative;
        overflow: hidden;
    }

    .categories-section {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }

    .features-section {
        background: #ffffff;
    }

    .success-section {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    }

    .cta-section {
        position: relative;
        overflow: hidden;
    }

    /* Stats Enhancement */
    .stats-row .stat-item {
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.1);
    }

    .stats-row .stat-item:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.05);
    }

    .stat-card {
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .stat-card:hover {
        transform: scale(1.05);
        background: rgba(255, 255, 255, 0.25) !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .display-1 {
            font-size: 3rem !important;
        }
        
        .floating-card-1, .floating-card-2, .floating-card-3, .floating-card-4, .floating-card-5 {
            display: none !important;
        }
        
        .particle {
            display: none;
        }
        
        .geometric-shape {
            display: none;
        }
        
        .main-card {
            margin-top: 2rem;
        }
    }

    /* Additional Enhancements */
    .badge {
        position: relative;
        overflow: hidden;
    }

    .badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        animation: shine 3s infinite;
    }

    .counter {
        transition: all 0.3s ease;
        color: inherit;
    }

    /* Feature List Enhancement */
    .feature-list li {
        transition: all 0.3s ease;
        padding: 0.25rem 0;
    }

    .feature-list li:hover {
        transform: translateX(5px);
    }

    /* Button Group Enhancement */
    .button-group .btn {
        position: relative;
        z-index: 1;
    }

    .cta-buttons .btn {
        position: relative;
        z-index: 1;
    }

    /* Benefits Grid Enhancement */
    .benefits-grid .benefit-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .benefits-grid .benefit-card:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px);
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Job Search Demo Function
    function openJobSearchDemo() {
        const modal = document.createElement('div');
        modal.className = 'modal fade';
        modal.id = 'jobSearchModal';
        modal.setAttribute('tabindex', '-1');
        
        modal.innerHTML = `
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow-2xl">
                    <div class="modal-header bg-primary text-white rounded-top-4">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-search me-2"></i>Browse Available Jobs
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="card border-0 bg-light rounded-3 hover-lift">
                                    <div class="card-body p-3">
                                        <h6 class="fw-bold mb-2">🚀 Frontend Developer</h6>
                                        <small class="text-muted">PT Tech Innovate • Remote</small>
                                        <div class="mt-2">
                                            <span class="badge bg-success rounded-pill">$80K</span>
                                            <span class="badge bg-primary rounded-pill">Remote</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 bg-light rounded-3 hover-lift">
                                    <div class="card-body p-3">
                                        <h6 class="fw-bold mb-2">📊 Data Scientist</h6>
                                        <small class="text-muted">Microsoft • Seattle</small>
                                        <div class="mt-2">
                                            <span class="badge bg-success rounded-pill">$120K</span>
                                            <span class="badge bg-info rounded-pill">Full-time</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 bg-light rounded-3 hover-lift">
                                    <div class="card-body p-3">
                                        <h6 class="fw-bold mb-2">🎨 UI/UX Designer</h6>
                                        <small class="text-muted">Creative Studio • Hybrid</small>
                                        <div class="mt-2">
                                            <span class="badge bg-success rounded-pill">$70K</span>
                                            <span class="badge bg-warning rounded-pill">Hybrid</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 bg-light rounded-3 hover-lift">
                                    <div class="card-body p-3">
                                        <h6 class="fw-bold mb-2">⚡ Full Stack Developer</h6>
                                        <small class="text-muted">StartupTech • On-site</small>
                                        <div class="mt-2">
                                            <span class="badge bg-success rounded-pill">$90K</span>
                                            <span class="badge bg-danger rounded-pill">On-site</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="fas fa-briefcase text-primary fa-3x"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Ready to start your job search?</h5>
                            <p class="text-muted mb-3">Join thousands of professionals who found their dream jobs with us</p>
                            <a href="{{ route('register.applicant') }}" class="btn btn-primary btn-lg rounded-pill px-4">
                                <i class="fas fa-user-plus me-2"></i>Create Free Account
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
        
        modal.addEventListener('hidden.bs.modal', function () {
            document.body.removeChild(modal);
        });
    }

    window.openJobSearchDemo = openJobSearchDemo;

    // Enhanced Counter animation
    function animateCounter(element, target) {
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
                element.classList.add('glow-number');
            }
            element.textContent = Math.floor(current);
        }, 40);
    }

    // Initialize counters with intersection observer
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                const target = parseInt(entry.target.getAttribute('data-target'));
                animateCounter(entry.target, target);
                entry.target.classList.add('counted');
            }
        });
    });

    document.querySelectorAll('.counter').forEach(counter => {
        counterObserver.observe(counter);
    });

    // Enhanced notification interactions
    document.querySelectorAll('.animate-notification').forEach((notification, index) => {
        notification.addEventListener('click', function() {
            const title = this.querySelector('h6')?.textContent || 'Notification';
            const subtitle = this.querySelector('.text-muted')?.textContent || '';
            
            // Create enhanced toast
            const toast = document.createElement('div');
            toast.className = 'position-fixed top-0 end-0 p-3';
            toast.style.zIndex = '1055';
            
            toast.innerHTML = `
                <div class="toast show border-0 shadow-2xl rounded-4" role="alert">
                    <div class="toast-header bg-primary text-white border-0 rounded-top-4">
                        <i class="fas fa-bell text-warning me-2"></i>
                        <strong class="me-auto">${title}</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body p-3">
                        ${subtitle}
                        <div class="mt-2">
                            <small class="text-success">
                                <i class="fas fa-check-circle me-1"></i>Notification viewed
                            </small>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            // Add animation class
            setTimeout(() => {
                toast.querySelector('.toast').classList.add('hover-lift');
            }, 100);
            
            setTimeout(() => {
                if (document.body.contains(toast)) {
                    document.body.removeChild(toast);
                }
            }, 5000);
        });

        // Add hover glow effect
        notification.addEventListener('mouseenter', function() {
            this.style.filter = 'drop-shadow(0 0 20px rgba(59, 130, 246, 0.5))';
        });

        notification.addEventListener('mouseleave', function() {
            this.style.filter = 'none';
        });
    });

    // Parallax effect for background elements
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.particle');
        
        parallaxElements.forEach((element, index) => {
            const speed = 0.5 + (index * 0.1);
            const yPos = -(scrolled * speed);
            element.style.transform = `translateY(${yPos}px)`;
        });
    });

    // Add scroll reveal animations
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    // Apply reveal animation to sections
    document.querySelectorAll('.category-card, .feature-card, .testimonial-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease';
        revealObserver.observe(card);
    });

    // Enhanced button interactions
    document.querySelectorAll('.animated-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.02)';
        });

        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Dynamic background particles
    function createDynamicParticle() {
        const particle = document.createElement('div');
        particle.className = 'position-absolute rounded-circle opacity-10';
        particle.style.width = Math.random() * 20 + 10 + 'px';
        particle.style.height = particle.style.width;
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = '100%';
        particle.style.backgroundColor = ['#fbbf24', '#06b6d4', '#10b981', '#3b82f6'][Math.floor(Math.random() * 4)];
        particle.style.animation = `float ${Math.random() * 10 + 15}s linear infinite`;
        particle.style.zIndex = '1';

        document.querySelector('.hero-section').appendChild(particle);

        setTimeout(() => {
            particle.remove();
        }, 20000);
    }

    // Create particles periodically
    setInterval(createDynamicParticle, 3000);

    console.log('🚀 Enhanced JobMatch Applicant Homepage loaded successfully!');
});
</script>
@endsection