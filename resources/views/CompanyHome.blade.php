@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden">
    <div class="hero-bg"></div>
    <div class="container-fluid px-0">
        <div class="row g-0 min-vh-100 align-items-center">
            <div class="col-lg-6 order-lg-1 order-2">
                <div class="hero-content p-5">
                    <div class="content-wrapper">
                        <span class="hero-badge badge bg-gradient-primary text-white px-4 py-2 rounded-pill mb-4 d-inline-block">
                            <i class="fas fa-crown me-2"></i>Premium Recruitment Platform
                        </span>
                        
                        <h1 class="hero-title display-1 fw-bold mb-4">
                            <span class="text-primary">HIRE</span><br>
                            <span class="text-dark">TOP</span><br>
                            <span class="text-gradient">TALENT</span>
                        </h1>
                        
                        <p class="hero-subtitle fs-4 text-muted mb-5 lh-base">
                            Connect with Indonesia's best professionals. Find qualified candidates who match your company culture and drive business growth.
                        </p>
                        
                        <div class="hero-actions mb-5">
                            <a href="{{ route('register.company') }}" class="btn btn-primary btn-xl me-3 mb-3" style="position: relative; z-index: 100;">
                                <i class="fas fa-rocket me-2"></i>Start Hiring Now
                            </a>
                            <a href="{{ route('login.company') }}" class="btn btn-outline-primary btn-xl mb-3" style="position: relative; z-index: 100;">
                                <i class="fas fa-sign-in-alt me-2"></i>Company Login
                            </a>
                        </div>
                        
                        <!-- Company Benefits -->
                        <div class="hero-benefits row g-3">
                            <div class="col-md-4">
                                <div class="benefit-item text-center p-3">
                                    <div class="benefit-icon bg-success rounded-circle mx-auto mb-2">
                                        <i class="fas fa-clock text-white"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Hire 3x Faster</h6>
                                    <small class="text-muted">Reduce time-to-hire</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="benefit-item text-center p-3">
                                    <div class="benefit-icon bg-warning rounded-circle mx-auto mb-2">
                                        <i class="fas fa-shield-alt text-white"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Quality Assured</h6>
                                    <small class="text-muted">Pre-verified candidates</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="benefit-item text-center p-3">
                                    <div class="benefit-icon bg-info rounded-circle mx-auto mb-2">
                                        <i class="fas fa-chart-line text-white"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">95% Success Rate</h6>
                                    <small class="text-muted">Proven track record</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 order-lg-2 order-1">
                <div class="hero-visual position-relative h-100">
                    <!-- Main Dashboard Preview -->
                    <div class="dashboard-preview">
                        <div class="dashboard-card main-card shadow-lg">
                            <div class="card-header bg-white border-0 p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="fw-bold mb-0">Recruitment Dashboard</h5>
                                    <span class="badge bg-success">Live</span>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <!-- Stats Row -->
                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <div class="stat-box bg-primary bg-opacity-10 rounded-3 p-3 text-center">
                                            <h4 class="text-primary fw-bold mb-0">247</h4>
                                            <small class="text-muted">Active Applications</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="stat-box bg-success bg-opacity-10 rounded-3 p-3 text-center">
                                            <h4 class="text-success fw-bold mb-0">18</h4>
                                            <small class="text-muted">Shortlisted</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Candidate Preview -->
                                <div class="candidate-preview">
                                    <h6 class="fw-bold mb-3">Top Candidates</h6>
                                    <div class="candidate-item d-flex align-items-center mb-2">
                                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&q=80" 
                                             class="rounded-circle me-3" width="40" height="40">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 fw-bold">Sarah Martinez</h6>
                                            <small class="text-muted">Senior Developer</small>
                                        </div>
                                        <div class="rating">
                                            <i class="fas fa-star text-warning"></i>
                                            <span class="fw-bold">4.9</span>
                                        </div>
                                    </div>
                                    <div class="candidate-item d-flex align-items-center">
                                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&q=80" 
                                             class="rounded-circle me-3" width="40" height="40">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 fw-bold">David Chen</h6>
                                            <small class="text-muted">Product Manager</small>
                                        </div>
                                        <div class="rating">
                                            <i class="fas fa-star text-warning"></i>
                                            <span class="fw-bold">4.8</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Notifications -->
                    <div class="floating-notification notification-1">
                        <div class="notification-card bg-white shadow-lg rounded-3 p-3">
                            <div class="d-flex align-items-center">
                                <div class="notification-icon bg-success rounded-circle me-3">
                                    <i class="fas fa-user-plus text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">New Application</h6>
                                    <small class="text-muted">Frontend Developer</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="floating-notification notification-2">
                        <div class="notification-card bg-white shadow-lg rounded-3 p-3">
                            <div class="d-flex align-items-center">
                                <div class="notification-icon bg-primary rounded-circle me-3">
                                    <i class="fas fa-calendar text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Interview Scheduled</h6>
                                    <small class="text-muted">Tomorrow 10:00 AM</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="floating-notification notification-3">
                        <div class="notification-card bg-white shadow-lg rounded-3 p-3">
                            <div class="d-flex align-items-center">
                                <div class="notification-icon bg-warning rounded-circle me-3">
                                    <i class="fas fa-handshake text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Offer Accepted</h6>
                                    <small class="text-muted">Senior Designer</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Stats Section -->
<section class="stats-section py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-12 mb-5">
                <h2 class="display-6 fw-bold mb-3">Trusted by Industry Leaders</h2>
                <p class="lead text-muted">Join thousands of companies who have transformed their hiring process</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stats-card text-center">
                    <div class="stats-icon bg-primary bg-opacity-10 rounded-circle mx-auto mb-3">
                        <i class="fas fa-building text-primary"></i>
                    </div>
                    <h3 class="stats-number text-primary fw-bold mb-2" data-target="2500">0</h3>
                    <p class="stats-label text-muted mb-0">Active Companies</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card text-center">
                    <div class="stats-icon bg-success bg-opacity-10 rounded-circle mx-auto mb-3">
                        <i class="fas fa-users text-success"></i>
                    </div>
                    <h3 class="stats-number text-success fw-bold mb-2" data-target="75000">0</h3>
                    <p class="stats-label text-muted mb-0">Qualified Candidates</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card text-center">
                    <div class="stats-icon bg-warning bg-opacity-10 rounded-circle mx-auto mb-3">
                        <i class="fas fa-handshake text-warning"></i>
                    </div>
                    <h3 class="stats-number text-warning fw-bold mb-2" data-target="12000">0</h3>
                    <p class="stats-label text-muted mb-0">Successful Hires</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card text-center">
                    <div class="stats-icon bg-info bg-opacity-10 rounded-circle mx-auto mb-3">
                        <i class="fas fa-star text-info"></i>
                    </div>
                    <h3 class="stats-number text-info fw-bold mb-2" data-target="98">0</h3>
                    <p class="stats-label text-muted mb-0">% Satisfaction Rate</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-6 fw-bold mb-3">Why Choose Our Platform?</h2>
                <p class="lead text-muted">Everything you need to find and hire the best talent</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card h-100">
                    <div class="feature-header mb-4">
                        <div class="feature-icon-large bg-gradient-primary rounded-4 p-4 mb-3">
                            <i class="fas fa-search-plus text-white fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">AI-Powered Matching</h4>
                    </div>
                    <div class="feature-body">
                        <p class="text-muted mb-4">Advanced algorithms match candidates based on skills, experience, and cultural fit for your company.</p>
                        <ul class="feature-list list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Skill-based matching</li>
                            <li><i class="fas fa-check text-success me-2"></i>Cultural fit analysis</li>
                            <li><i class="fas fa-check text-success me-2"></i>Experience evaluation</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-card h-100">
                    <div class="feature-header mb-4">
                        <div class="feature-icon-large bg-gradient-success rounded-4 p-4 mb-3">
                            <i class="fas fa-shield-check text-white fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Verified Professionals</h4>
                    </div>
                    <div class="feature-body">
                        <p class="text-muted mb-4">All candidates undergo thorough verification process including background checks and skill assessments.</p>
                        <ul class="feature-list list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Background verification</li>
                            <li><i class="fas fa-check text-success me-2"></i>Skill assessments</li>
                            <li><i class="fas fa-check text-success me-2"></i>Reference checks</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-card h-100">
                    <div class="feature-header mb-4">
                        <div class="feature-icon-large bg-gradient-warning rounded-4 p-4 mb-3">
                            <i class="fas fa-chart-line text-white fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Analytics Dashboard</h4>
                    </div>
                    <div class="feature-body">
                        <p class="text-muted mb-4">Track your hiring performance with detailed analytics and insights to optimize your recruitment strategy.</p>
                        <ul class="feature-list list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Hiring metrics</li>
                            <li><i class="fas fa-check text-success me-2"></i>Performance tracking</li>
                            <li><i class="fas fa-check text-success me-2"></i>ROI analysis</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="pricing-section py-5 bg-light position-relative overflow-hidden">
    <div class="pricing-bg-pattern"></div>
    <div class="container position-relative">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <span class="pricing-badge badge bg-primary text-white px-4 py-2 rounded-pill mb-3 d-inline-block">
                    <i class="fas fa-tag me-2"></i>Pricing Plans
                </span>
                <h2 class="display-5 fw-bold mb-3">Simple, Transparent Pricing</h2>
                <p class="lead text-muted">Choose the perfect plan that scales with your hiring needs</p>
                
                <!-- Pricing Toggle -->
                <div class="pricing-toggle d-flex align-items-center justify-content-center mt-4">
                    <span class="me-3 fw-semibold">Monthly</span>
                    <div class="form-check form-switch">
                        <input class="form-check-input pricing-switch" type="checkbox" id="pricingSwitch">
                        <label class="form-check-label" for="pricingSwitch"></label>
                    </div>
                    <span class="ms-3 fw-semibold">Annual <span class="badge bg-success ms-2">Save 20%</span></span>
                </div>
            </div>
        </div>
        
        <div class="row g-4 justify-content-center">
            <!-- Starter Plan -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card starter-card h-100 position-relative">
                    <div class="pricing-glow"></div>
                    <div class="card-content">
                        <div class="pricing-header text-center p-4 pb-3">
                            <div class="pricing-icon bg-light rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-rocket text-primary fa-lg"></i>
                            </div>
                            <h4 class="fw-bold mb-2">Starter</h4>
                            <p class="text-muted mb-3">Perfect for small companies</p>
                            <div class="price-display">
                                <div class="monthly-price">
                                    <span class="price-currency text-muted">Rp</span>
                                    <span class="price-amount text-primary fw-bold">500K</span>
                                    <span class="price-period text-muted">/month</span>
                                </div>
                                <div class="annual-price d-none">
                                    <span class="price-currency text-muted">Rp</span>
                                    <span class="price-amount text-primary fw-bold">4.8M</span>
                                    <span class="price-period text-muted">/year</span>
                                    <div class="savings-badge mt-2">
                                        <span class="badge bg-success">Save Rp 1.2M</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pricing-body p-4 pt-0">
                            <ul class="pricing-features list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>Up to 5 job postings</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>100 candidate views</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>Basic matching algorithm</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>Email support</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>Standard templates</li>
                            </ul>
                        </div>
                        <div class="pricing-footer p-4 pt-0">
                            <a href="{{ route('register.company') }}" class="btn btn-outline-primary w-100 btn-lg rounded-pill">
                                <i class="fas fa-play me-2"></i>Get Started
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Professional Plan -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card featured-card h-100 position-relative">
                    <div class="pricing-badge-ribbon">
                        <span class="badge-text">Most Popular</span>
                    </div>
                    <div class="pricing-glow featured-glow"></div>
                    <div class="card-content">
                        <div class="pricing-header text-center p-4 pb-3">
                            <div class="pricing-icon bg-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-crown text-white fa-lg"></i>
                            </div>
                            <h4 class="fw-bold mb-2">Professional</h4>
                            <p class="text-muted mb-3">For growing businesses</p>
                            <div class="price-display">
                                <div class="monthly-price">
                                    <span class="price-currency text-muted">Rp</span>
                                    <span class="price-amount text-primary fw-bold">1.5M</span>
                                    <span class="price-period text-muted">/month</span>
                                </div>
                                <div class="annual-price d-none">
                                    <span class="price-currency text-muted">Rp</span>
                                    <span class="price-amount text-primary fw-bold">14.4M</span>
                                    <span class="price-period text-muted">/year</span>
                                    <div class="savings-badge mt-2">
                                        <span class="badge bg-success">Save Rp 3.6M</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pricing-body p-4 pt-0">
                            <ul class="pricing-features list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>Unlimited job postings</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>500 candidate views</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>AI-powered matching</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>Analytics dashboard</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>Priority support</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>Custom branding</li>
                            </ul>
                        </div>
                        <div class="pricing-footer p-4 pt-0">
                            <a href="{{ route('register.company') }}" class="btn btn-primary w-100 btn-lg rounded-pill">
                                <i class="fas fa-star me-2"></i>Choose Plan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Enterprise Plan -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card enterprise-card h-100 position-relative">
                    <div class="pricing-glow"></div>
                    <div class="card-content">
                        <div class="pricing-header text-center p-4 pb-3">
                            <div class="pricing-icon bg-gradient-dark rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-building text-white fa-lg"></i>
                            </div>
                            <h4 class="fw-bold mb-2">Enterprise</h4>
                            <p class="text-muted mb-3">For large organizations</p>
                            <div class="price-display">
                                <div class="monthly-price">
                                    <span class="price-currency text-muted">Rp</span>
                                    <span class="price-amount text-primary fw-bold">3M</span>
                                    <span class="price-period text-muted">/month</span>
                                </div>
                                <div class="annual-price d-none">
                                    <span class="price-currency text-muted">Rp</span>
                                    <span class="price-amount text-primary fw-bold">28.8M</span>
                                    <span class="price-period text-muted">/year</span>
                                    <div class="savings-badge mt-2">
                                        <span class="badge bg-success">Save Rp 7.2M</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pricing-body p-4 pt-0">
                            <ul class="pricing-features list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>Everything in Professional</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>Unlimited candidate views</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>Custom integrations</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>Dedicated account manager</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>24/7 phone support</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-3"></i>White-label solution</li>
                            </ul>
                        </div>
                        <div class="pricing-footer p-4 pt-0">
                            <a href="#" class="btn btn-outline-dark w-100 btn-lg rounded-pill" onclick="alert('Contact our sales team for enterprise pricing!')">
                                <i class="fas fa-phone me-2"></i>Contact Sales
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Features Comparison -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <p class="text-muted mb-4">All plans include: SSL Security, Mobile App Access, Data Export, and 99.9% Uptime Guarantee</p>
                <div class="pricing-guarantees d-flex flex-wrap justify-content-center gap-4">
                    <div class="guarantee-item d-flex align-items-center">
                        <i class="fas fa-shield-alt text-success me-2"></i>
                        <span class="fw-semibold">30-Day Money Back</span>
                    </div>
                    <div class="guarantee-item d-flex align-items-center">
                        <i class="fas fa-headset text-success me-2"></i>
                        <span class="fw-semibold">24/7 Support</span>
                    </div>
                    <div class="guarantee-item d-flex align-items-center">
                        <i class="fas fa-sync-alt text-success me-2"></i>
                        <span class="fw-semibold">Cancel Anytime</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-6 fw-bold mb-3">What HR Leaders Say</h2>
                <p class="lead text-muted">Success stories from companies using our platform</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card h-100">
                    <div class="testimonial-header mb-3">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b647?ixlib=rb-4.0.3&auto=format&fit=crop&w=80&q=80" 
                                 class="testimonial-avatar rounded-circle me-3">
                            <div>
                                <h6 class="fw-bold mb-0">Linda Sari</h6>
                                <small class="text-muted">HR Director at PT Teknologi Maju</small>
                            </div>
                        </div>
                        <div class="testimonial-rating mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                    <div class="testimonial-body">
                        <p class="text-muted">"Platform ini mengubah cara kami merekrut. Kami berhasil mengurangi waktu hiring dari 3 bulan menjadi 2 minggu. Kualitas kandidat juga sangat baik."</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card h-100">
                    <div class="testimonial-header mb-3">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=80&q=80" 
                                 class="testimonial-avatar rounded-circle me-3">
                            <div>
                                <h6 class="fw-bold mb-0">Budi Santoso</h6>
                                <small class="text-muted">CEO at PT Digital Inovasi</small>
                            </div>
                        </div>
                        <div class="testimonial-rating mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                    <div class="testimonial-body">
                        <p class="text-muted">"ROI yang luar biasa! Biaya per hire turun 60% sejak menggunakan platform ini. Tim yang kami rekrut sekarang performa mereka sangat exceptional."</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card h-100">
                    <div class="testimonial-header mb-3">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=80&q=80" 
                                 class="testimonial-avatar rounded-circle me-3">
                            <div>
                                <h6 class="fw-bold mb-0">Maya Dewi</h6>
                                <small class="text-muted">Talent Acquisition Manager at PT Fintech Solution</small>
                            </div>
                        </div>
                        <div class="testimonial-rating mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                    <div class="testimonial-body">
                        <p class="text-muted">"Dashboard analytics memberikan insight yang sangat valuable. Kami bisa track conversion rate dan optimize hiring strategy dengan data yang akurat."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 bg-gradient-primary text-white position-relative overflow-hidden">
    <div class="cta-pattern"></div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="cta-content">
                    <h2 class="display-5 fw-bold mb-3">Ready to Transform Your Hiring?</h2>
                    <p class="fs-5 mb-4 opacity-90">Join 2,500+ companies who trust us to find their best talent. Start your free trial today.</p>
                    <div class="cta-actions">
                        <a href="{{ route('register.company') }}" class="btn btn-light btn-lg me-3 mb-3">
                            <i class="fas fa-rocket me-2"></i>Start Free Trial
                        </a>
                        <a href="#" class="btn btn-outline-light btn-lg mb-3" onclick="alert('Demo will be scheduled!')">
                            <i class="fas fa-play me-2"></i>Watch Demo
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cta-visual text-center">
                    <div class="cta-icon-grid">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="cta-metric-card bg-white bg-opacity-20 rounded-3 p-3">
                                    <i class="fas fa-users fa-2x mb-2"></i>
                                    <h5 class="fw-bold mb-0">2,500+</h5>
                                    <small>Companies</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="cta-metric-card bg-white bg-opacity-20 rounded-3 p-3">
                                    <i class="fas fa-briefcase fa-2x mb-2"></i>
                                    <h5 class="fw-bold mb-0">12K+</h5>
                                    <small>Successful Hires</small>
                                </div>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
    :root {
        --primary-color: #3b82f6;
        --primary-dark: #1e40af;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --info-color: #06b6d4;
        --dark-color: #1f2937;
    }

    body {
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        line-height: 1.6;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M 50 0 L 0 0 0 50" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
        opacity: 0.1;
    }

    .hero-content {
        padding: 4rem 0;
    }

    .hero-title {
        font-size: 4.5rem;
        line-height: 0.9;
        font-weight: 800;
    }

    .text-gradient {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-badge {
        animation: pulse 2s infinite;
    }

    .benefit-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Hero Visual */
    .hero-visual {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none; /* Prevent blocking clicks */
    }

    .hero-visual * {
        pointer-events: auto; /* Re-enable for child elements */
    }

    .dashboard-preview {
        width: 100%;
        max-width: 400px;
        position: relative;
        z-index: 5;
        pointer-events: auto;
    }

    .dashboard-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        transform: perspective(1000px) rotateY(-5deg) rotateX(5deg);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    }

    .floating-notification {
        position: absolute;
        animation: floatNotification 6s ease-in-out infinite;
        pointer-events: none; /* Prevent blocking main content clicks */
        z-index: 1; /* Lower z-index than buttons */
    }

    .floating-notification .notification-card {
        pointer-events: auto; /* Enable clicks on notification itself */
    }

    .notification-1 {
        top: 10%;
        left: -10%;
        animation-delay: 0s;
    }

    .notification-2 {
        top: 50%;
        right: -15%;
        animation-delay: 2s;
    }

    .notification-3 {
        bottom: 20%;
        left: -5%;
        animation-delay: 4s;
    }

    .notification-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Stats Section */
    .stats-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }

    .stats-number {
        font-size: 3rem;
        font-weight: 800;
    }

    /* Features Section */
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .feature-icon-large {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
    }

    /* Pricing Section */
    .pricing-section {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }

    .pricing-bg-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="1" fill="rgba(59,130,246,0.1)"/><circle cx="80" cy="20" r="1" fill="rgba(59,130,246,0.1)"/><circle cx="20" cy="80" r="1" fill="rgba(59,130,246,0.1)"/><circle cx="80" cy="80" r="1" fill="rgba(59,130,246,0.1)"/></svg>');
        background-size: 100px 100px;
        opacity: 0.3;
    }

    .pricing-toggle .pricing-switch {
        width: 60px;
        height: 30px;
        background-color: #e2e8f0;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .pricing-toggle .pricing-switch:checked {
        background-color: var(--primary-color);
    }

    .pricing-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .pricing-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .pricing-glow {
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.05) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .pricing-card:hover .pricing-glow {
        opacity: 1;
    }

    .featured-card {
        border: 2px solid var(--primary-color);
        transform: scale(1.02);
        position: relative;
    }

    .featured-card:hover {
        transform: scale(1.02) translateY(-8px);
    }

    .featured-glow {
        background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
        opacity: 1;
    }

    .pricing-badge-ribbon {
        position: absolute;
        top: 20px;
        right: -35px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 8px 45px;
        font-size: 0.85rem;
        font-weight: 700;
        transform: rotate(45deg);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 10;
    }

    .pricing-icon {
        width: 60px;
        height: 60px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .price-amount {
        font-size: 3rem;
        font-weight: 900;
        letter-spacing: -2px;
    }

    .price-currency, .price-period {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .pricing-features li {
        padding: 8px 0;
        transition: all 0.2s ease;
    }

    .pricing-features li:hover {
        transform: translateX(5px);
        color: var(--primary-color);
    }

    .guarantee-item {
        padding: 10px 20px;
        background: rgba(16, 185, 129, 0.1);
        border-radius: 25px;
        margin: 5px;
    }

    .bg-gradient-dark {
        background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
    }

    .savings-badge {
        animation: pulse 2s infinite;
    }

    /* Testimonials */
    .testimonial-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        border-color: var(--primary-color);
    }

    .testimonial-avatar {
        width: 60px;
        height: 60px;
        object-fit: cover;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    }

    .cta-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
        background-size: 50px 50px;
    }

    .cta-metric-card {
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .cta-metric-card:hover {
        background: rgba(255, 255, 255, 0.3) !important;
        transform: translateY(-5px);
    }

    /* Buttons */
    .btn-xl {
        padding: 15px 30px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
    }

    .btn {
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Emergency Button Fix */
    .btn, a.btn, button.btn {
        pointer-events: auto !important;
        position: relative !important;
        z-index: 999 !important;
        cursor: pointer !important;
    }

    .hero-actions .btn {
        z-index: 1001 !important;
    }

    /* Ensure no overlays block buttons */
    .hero-bg::before,
    .hero-section::before {
        pointer-events: none !important;
    }

    @keyframes floatNotification {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
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

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .animate-on-scroll.animated {
        opacity: 1;
        transform: translateY(0);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 3rem;
        }
        
        .dashboard-preview {
            max-width: 300px;
        }
        
        .floating-notification {
            display: none;
        }
        
        .stats-number {
            font-size: 2rem;
        }
        
        .pricing-card.featured {
            transform: none;
        }
        
        .pricing-card.featured:hover {
            transform: translateY(-5px);
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .feature-card,
        .pricing-card,
        .testimonial-card {
            margin-bottom: 2rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter Animation
    function animateCounter(element, target) {
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            if (target >= 1000) {
                element.textContent = Math.floor(current / 1000) + 'K+';
            } else {
                element.textContent = Math.floor(current) + (target < 100 ? '%' : '+');
            }
        }, 40);
    }

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                
                // Animate counters
                if (entry.target.classList.contains('stats-number')) {
                    const target = parseInt(entry.target.getAttribute('data-target'));
                    animateCounter(entry.target, target);
                }
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.feature-card, .pricing-card, .testimonial-card, .stats-card').forEach(el => {
        el.classList.add('animate-on-scroll');
        observer.observe(el);
    });

    // Observe stats numbers
    document.querySelectorAll('.stats-number').forEach(el => {
        observer.observe(el);
    });

    // Dashboard preview interaction
    const dashboardCard = document.querySelector('.dashboard-card');
    if (dashboardCard) {
        dashboardCard.addEventListener('mouseenter', function() {
            this.style.transform = 'perspective(1000px) rotateY(-2deg) rotateX(2deg) scale(1.05)';
        });
        
        dashboardCard.addEventListener('mouseleave', function() {
            this.style.transform = 'perspective(1000px) rotateY(-5deg) rotateX(5deg) scale(1)';
        });
    }

    // Testimonial cards interaction
    document.querySelectorAll('.testimonial-card').forEach(card => {
        card.addEventListener('click', function() {
            const name = this.querySelector('h6').textContent;
            const company = this.querySelector('small').textContent;
            
            // Add click effect
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
            
            alert(`Testimoni dari ${name} - ${company}`);
        });
    });

    // Pricing toggle functionality
    const pricingSwitch = document.querySelector('.pricing-switch');
    if (pricingSwitch) {
        pricingSwitch.addEventListener('change', function() {
            const monthlyPrices = document.querySelectorAll('.monthly-price');
            const annualPrices = document.querySelectorAll('.annual-price');
            
            if (this.checked) {
                // Show annual prices
                monthlyPrices.forEach(price => price.classList.add('d-none'));
                annualPrices.forEach(price => price.classList.remove('d-none'));
            } else {
                // Show monthly prices
                monthlyPrices.forEach(price => price.classList.remove('d-none'));
                annualPrices.forEach(price => price.classList.add('d-none'));
            }
        });
    }

    // Pricing card enhanced interactions
    document.querySelectorAll('.pricing-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            if (!this.classList.contains('featured-card')) {
                this.style.borderColor = 'var(--primary-color)';
                this.style.borderWidth = '2px';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            if (!this.classList.contains('featured-card')) {
                this.style.borderColor = 'transparent';
                this.style.borderWidth = '2px';
            }
        });
    });

    // Floating notification interaction
    document.querySelectorAll('.floating-notification').forEach(notification => {
        notification.addEventListener('click', function() {
            const title = this.querySelector('h6').textContent;
            alert(`Notification: ${title}`);
        });
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Enhanced button interactions with debugging
    document.querySelectorAll('.btn').forEach(btn => {
        // Ensure buttons are clickable
        btn.style.pointerEvents = 'auto';
        btn.style.position = 'relative';
        btn.style.zIndex = '100';
        
        btn.addEventListener('click', function(e) {
            console.log('Button clicked:', this.textContent.trim());
            console.log('Button href:', this.getAttribute('href'));
            console.log('Button onclick:', this.getAttribute('onclick'));
            
            // If it's a link with href, let it navigate normally
            if (this.getAttribute('href') && this.getAttribute('href') !== '#') {
                return true;
            }
        });
        
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.02)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Fix any overlay issues
    document.querySelectorAll('.hero-actions .btn').forEach(btn => {
        btn.style.zIndex = '1000';
        btn.style.position = 'relative';
        btn.style.pointerEvents = 'auto';
        
        // Debug click events
        btn.addEventListener('click', function(e) {
            console.log('Hero button clicked:', this.textContent.trim());
            console.log('Event target:', e.target);
            console.log('Current target:', e.currentTarget);
        });
    });

    // Check for any elements that might be blocking clicks
    document.addEventListener('click', function(e) {
        console.log('Click detected at:', e.clientX, e.clientY);
        console.log('Element clicked:', e.target);
        console.log('Element z-index:', window.getComputedStyle(e.target).zIndex);
    });

    // CTA metric cards interaction
    document.querySelectorAll('.cta-metric-card').forEach(card => {
        card.addEventListener('click', function() {
            const metric = this.querySelector('h5').textContent;
            const label = this.querySelector('small').textContent;
            alert(`${metric} ${label} dan terus bertambah!`);
        });
    });

    // Emergency button click handler
    setTimeout(() => {
        document.querySelectorAll('.hero-actions .btn').forEach((btn, index) => {
            btn.addEventListener('click', function(e) {
                console.log(`Button ${index + 1} clicked:`, this.textContent.trim());
                
                const href = this.getAttribute('href');
                if (href && href !== '#') {
                    console.log('Navigating to:', href);
                    // Force navigation if needed
                    if (e.defaultPrevented) {
                        e.preventDefault();
                        window.location.href = href;
                    }
                } else {
                    console.log('No valid href found');
                    alert('Button clicked but no valid link found. Please check routing.');
                }
            });
        });
    }, 1000);

    console.log('Company home page initialized successfully!');
});
</script>
@endsection