@extends('layouts.app')

@section('content')
<!-- Hero Section with Background Image -->
<section class="position-relative overflow-hidden min-vh-100 d-flex align-items-center" style="background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(30, 41, 59, 0.9)), url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover;">
    
    <!-- Enhanced Animated Background Particles -->
    <div class="position-absolute w-100 h-100 overflow-hidden" style="z-index: 1;">
        <div class="position-absolute bg-warning rounded-circle opacity-25" style="width: 100px; height: 100px; top: 15%; left: 5%; animation: float 20s ease-in-out infinite;"></div>
        <div class="position-absolute bg-info rounded-circle opacity-25" style="width: 150px; height: 150px; top: 60%; right: 8%; animation: float 25s ease-in-out infinite reverse;"></div>
        <div class="position-absolute bg-success rounded-circle opacity-25" style="width: 80px; height: 80px; top: 35%; right: 25%; animation: float 15s ease-in-out infinite;"></div>
        <div class="position-absolute bg-primary rounded-circle opacity-25" style="width: 120px; height: 120px; bottom: 25%; left: 15%; animation: float 18s ease-in-out infinite reverse;"></div>
        <div class="position-absolute bg-danger rounded-circle opacity-20" style="width: 60px; height: 60px; top: 25%; left: 30%; animation: float 22s ease-in-out infinite;"></div>
        <div class="position-absolute bg-purple rounded-circle opacity-20" style="width: 90px; height: 90px; bottom: 40%; right: 35%; animation: float 16s ease-in-out infinite reverse;"></div>
    </div>
    
    <div class="container-fluid position-relative" style="z-index: 10;">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 order-lg-1 order-2">
                <div class="p-5">
                    <span class="badge bg-gradient-primary text-white px-4 py-2 rounded-pill mb-4 d-inline-block fw-bold">
                        <i class="fas fa-crown me-2"></i>Premium Recruitment Platform
                    </span>
                    
                    <h1 class="display-1 fw-bold mb-4 lh-1">
                        <span class="text-warning">HIRE</span><br>
                        <span class="text-white">TOP</span><br>
                        <span class="text-info">TALENT</span>
                    </h1>
                    
                    <p class="fs-4 text-white-50 mb-5 lh-base">
                        Connect with Indonesia's best professionals. Find qualified candidates who match your company culture and drive business growth.
                    </p>
                    
                    <div class="mb-5">
                        <a href="{{ route('register.company') }}" class="btn btn-warning btn-lg me-3 mb-3 px-5 py-3 fw-bold rounded-pill shadow-lg">
                            <i class="fas fa-rocket me-2"></i>Start Hiring Now
                        </a>
                        <a href="{{ route('login.company') }}" class="btn btn-outline-light btn-lg mb-3 px-5 py-3 fw-bold rounded-pill">
                            <i class="fas fa-sign-in-alt me-2"></i>Company Login
                        </a>
                    </div>
                    
                    <!-- Benefits dengan Bootstrap Grid -->
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="text-center p-3">
                                <div class="bg-success rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <h6 class="fw-bold mb-1 text-white">3x Faster</h6>
                                <small class="text-white-50">Hiring Speed</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3">
                                <div class="bg-info rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-shield-alt text-white"></i>
                                </div>
                                <h6 class="fw-bold mb-1 text-white">Verified</h6>
                                <small class="text-white-50">Candidates</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3">
                                <div class="bg-warning rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-chart-line text-dark"></i>
                                </div>
                                <h6 class="fw-bold mb-1 text-white">95% Success</h6>
                                <small class="text-white-50">Rate</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 order-lg-2 order-1 d-flex align-items-center justify-content-center min-vh-100 position-relative" style="z-index: 5;">
                <!-- Compact Success Card -->
                <div style="max-width: 320px; width: 100%;">
                    <div class="card border-0 shadow-lg position-relative" style="border-radius: 16px; backdrop-filter: blur(15px); background: rgba(255, 255, 255, 0.95);">
                        <!-- Header -->
                        <div class="card-header border-0 p-3 text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 16px 16px 0 0;">
                            <div class="bg-white bg-opacity-20 rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-trophy text-white fa-lg"></i>
                            </div>
                            <h6 class="fw-bold text-white mb-0">Success Stories</h6>
                            <small class="text-white-50">Real hiring results</small>
                        </div>
                        
                        <div class="card-body p-3">
                            <!-- Quick Stats -->
                            <div class="bg-gradient-primary text-white rounded-3 p-3 text-center mb-3">
                                <div class="row g-0">
                                    <div class="col-4">
                                        <h5 class="fw-bold mb-0 counter" data-target="2500">0</h5>
                                        <small class="opacity-75">Companies</small>
                                    </div>
                                    <div class="col-4 border-start border-end border-white border-opacity-25">
                                        <h5 class="fw-bold mb-0 counter" data-target="75">0</h5>
                                        <small class="opacity-75">Talents</small>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="fw-bold mb-0 counter" data-target="98">0</h5>
                                        <small class="opacity-75">% Success</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Success -->
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-success rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                        <i class="fas fa-rocket text-white small"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 small fw-bold">PT Tech Startup</h6>
                                        <small class="text-muted">Hired 15 developers in 2 weeks</small>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                        <i class="fas fa-handshake text-white small"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 small fw-bold">CV Digital Solutions</h6>
                                        <small class="text-muted">8 marketing specialists hired</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Key Benefits -->
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="bg-info bg-opacity-10 rounded-2 p-2 text-center">
                                        <i class="fas fa-clock text-info small"></i>
                                        <div class="small fw-bold text-info">3x Faster</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-success bg-opacity-10 rounded-2 p-2 text-center">
                                        <i class="fas fa-shield-check text-success small"></i>
                                        <div class="small fw-bold text-success">Verified</div>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA -->
                            <div class="text-center">
                                <button class="btn btn-primary px-3 py-2 rounded-pill fw-bold w-100" onclick="openYouTubeDemo()">
                                    <i class="fas fa-play me-1"></i>Watch Demo
                                </button>
                                <small class="text-muted mt-2 d-block">See how 2,500+ companies succeed</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Floating Notifications tetap sama -->
                <div class="position-absolute floating-notification" style="top: 8%; left: -12%; animation: floatNotification 10s ease-in-out infinite;">
                    <div class="card border-0 shadow-lg rounded-4 p-3" style="backdrop-filter: blur(15px); background: rgba(255, 255, 255, 0.95); border: 1px solid rgba(255, 255, 255, 0.3);">
                        <div class="d-flex align-items-center">
                            <div class="bg-success rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-user-plus text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">New Company Joined</h6>
                                <small class="text-muted">PT Digital Startup</small>
                                <small class="text-success d-block fw-semibold">2 mins ago</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="position-absolute floating-notification" style="top: 45%; right: -18%; animation: floatNotification 12s ease-in-out infinite; animation-delay: 3s;">
                    <div class="card border-0 shadow-lg rounded-4 p-3" style="backdrop-filter: blur(15px); background: rgba(255, 255, 255, 0.95); border: 1px solid rgba(255, 255, 255, 0.3);">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-handshake text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">Successful Match</h6>
                                <small class="text-muted">Senior Developer Hired</small>
                                <small class="text-primary d-block fw-semibold">5 mins ago</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="position-absolute floating-notification" style="bottom: 18%; left: -8%; animation: floatNotification 9s ease-in-out infinite; animation-delay: 6s;">
                    <div class="card border-0 shadow-lg rounded-4 p-3" style="backdrop-filter: blur(15px); background: rgba(255, 255, 255, 0.95); border: 1px solid rgba(255, 255, 255, 0.3);">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-star text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">5-Star Review</h6>
                                <small class="text-muted">"Excellent Platform!"</small>
                                <small class="text-warning d-block fw-semibold">10 mins ago</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="position-absolute floating-notification" style="top: 70%; right: -10%; animation: floatNotification 11s ease-in-out infinite; animation-delay: 9s;">
                    <div class="card border-0 shadow-lg rounded-4 p-3" style="backdrop-filter: blur(15px); background: rgba(255, 255, 255, 0.95); border: 1px solid rgba(255, 255, 255, 0.3);">
                        <div class="d-flex align-items-center">
                            <div class="bg-info rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-trophy text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">Hiring Goal Achieved</h6>
                                <small class="text-muted">50 Hires This Month</small>
                                <small class="text-info d-block fw-semibold">Just now</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3">
                <i class="fas fa-chart-line me-2"></i>Our Impact
            </span>
            <h2 class="display-6 fw-bold mb-3">Trusted by Industry Leaders</h2>
            <p class="lead text-muted">Join thousands of companies who have transformed their hiring process</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 text-center p-4 hover-card">
                    <div class="bg-primary bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-building text-primary fa-2x"></i>
                    </div>
                    <h3 class="text-primary fw-bold mb-2 stats-counter" data-target="2500">0</h3>
                    <p class="text-muted mb-0">Active Companies</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 text-center p-4 hover-card">
                    <div class="bg-success bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-users text-success fa-2x"></i>
                    </div>
                    <h3 class="text-success fw-bold mb-2 stats-counter" data-target="75000">0</h3>
                    <p class="text-muted mb-0">Qualified Candidates</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 text-center p-4 hover-card">
                    <div class="bg-warning bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-handshake text-warning fa-2x"></i>
                    </div>
                    <h3 class="text-warning fw-bold mb-2 stats-counter" data-target="12000">0</h3>
                    <p class="text-muted mb-0">Successful Hires</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 text-center p-4 hover-card">
                    <div class="bg-info bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-star text-info fa-2x"></i>
                    </div>
                    <h3 class="text-info fw-bold mb-2 stats-counter" data-target="98">0</h3>
                    <p class="text-muted mb-0">% Satisfaction Rate</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-success text-white px-3 py-2 rounded-pill mb-3">
                <i class="fas fa-star me-2"></i>Features
            </span>
            <h2 class="display-6 fw-bold mb-3">Why Choose Our Platform?</h2>
            <p class="lead text-muted">Everything you need to find and hire the best talent</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 p-4 hover-card">
                    <div class="text-center mb-4">
                        <div class="bg-primary rounded-4 p-4 d-inline-block mb-3">
                            <i class="fas fa-search-plus text-white fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">AI-Powered Matching</h4>
                    </div>
                    <p class="text-muted mb-4">Advanced algorithms match candidates based on skills, experience, and cultural fit.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Skill-based matching</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Cultural fit analysis</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Experience evaluation</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 p-4 hover-card">
                    <div class="text-center mb-4">
                        <div class="bg-success rounded-4 p-4 d-inline-block mb-3">
                            <i class="fas fa-shield-check text-white fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Verified Professionals</h4>
                    </div>
                    <p class="text-muted mb-4">All candidates undergo thorough verification including background checks and assessments.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Background verification</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Skill assessments</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Reference checks</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 p-4 hover-card">
                    <div class="text-center mb-4">
                        <div class="bg-warning rounded-4 p-4 d-inline-block mb-3">
                            <i class="fas fa-chart-line text-white fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Analytics Dashboard</h4>
                    </div>
                    <p class="text-muted mb-4">Track hiring performance with detailed analytics and insights to optimize strategy.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Hiring metrics</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Performance tracking</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>ROI analysis</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-warning text-dark px-4 py-2 rounded-pill mb-3 fw-bold">
                <i class="fas fa-tag me-2"></i>Pricing Plans
            </span>
            <h2 class="display-5 fw-bold mb-3">Simple, Transparent Pricing</h2>
            <p class="lead text-muted">Choose the perfect plan that scales with your hiring needs</p>
            
            <!-- Pricing Toggle -->
            <div class="d-flex align-items-center justify-content-center mt-4">
                <span class="me-3 fw-semibold">Monthly</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="pricingSwitch" style="width: 60px; height: 30px;">
                </div>
                <span class="ms-3 fw-semibold">Annual <span class="badge bg-success ms-2">Save 20%</span></span>
            </div>
        </div>
        
        <div class="row g-4 justify-content-center">
            <!-- Starter Plan -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body text-center p-4">
                        <div class="bg-light rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-rocket text-primary fa-lg"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Starter</h4>
                        <p class="text-muted mb-3">Perfect for small companies</p>
                        <div class="mb-4 monthly-price">
                            <span class="text-muted">Rp</span>
                            <span class="display-6 text-primary fw-bold">500K</span>
                            <span class="text-muted">/month</span>
                        </div>
                        <div class="mb-4 annual-price d-none">
                            <span class="text-muted">Rp</span>
                            <span class="display-6 text-primary fw-bold">4.8M</span>
                            <span class="text-muted">/year</span>
                            <div class="mt-2">
                                <span class="badge bg-success">Save Rp 1.2M</span>
                            </div>
                        </div>
                        <ul class="list-unstyled mb-4 text-start">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Up to 5 job postings</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>100 candidate views</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Basic matching</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Email support</li>
                        </ul>
                        <a href="{{ route('register.company') }}" class="btn btn-outline-primary w-100 btn-lg rounded-pill">
                            <i class="fas fa-play me-2"></i>Get Started
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Professional Plan -->
            <div class="col-lg-4">
                <div class="card border-primary shadow h-100 position-relative" style="border-width: 3px; transform: scale(1.05);">
                    <div class="position-absolute top-0 start-50 translate-middle">
                        <span class="badge bg-primary px-4 py-2 fw-bold">Most Popular</span>
                    </div>
                    <div class="card-body text-center p-4">
                        <div class="bg-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-crown text-white fa-lg"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Professional</h4>
                        <p class="text-muted mb-3">For growing businesses</p>
                        <div class="mb-4 monthly-price">
                            <span class="text-muted">Rp</span>
                            <span class="display-6 text-primary fw-bold">1.5M</span>
                            <span class="text-muted">/month</span>
                        </div>
                        <div class="mb-4 annual-price d-none">
                            <span class="text-muted">Rp</span>
                            <span class="display-6 text-primary fw-bold">14.4M</span>
                            <span class="text-muted">/year</span>
                            <div class="mt-2">
                                <span class="badge bg-success">Save Rp 3.6M</span>
                            </div>
                        </div>
                        <ul class="list-unstyled mb-4 text-start">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Unlimited job postings</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>500 candidate views</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>AI-powered matching</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Analytics dashboard</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Priority support</li>
                        </ul>
                        <a href="{{ route('register.company') }}" class="btn btn-primary w-100 btn-lg rounded-pill">
                            <i class="fas fa-star me-2"></i>Choose Plan
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Enterprise Plan -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body text-center p-4">
                        <div class="bg-dark rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-building text-white fa-lg"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Enterprise</h4>
                        <p class="text-muted mb-3">For large organizations</p>
                        <div class="mb-4 monthly-price">
                            <span class="text-muted">Rp</span>
                            <span class="display-6 text-primary fw-bold">3M</span>
                            <span class="text-muted">/month</span>
                        </div>
                        <div class="mb-4 annual-price d-none">
                            <span class="text-muted">Rp</span>
                            <span class="display-6 text-primary fw-bold">28.8M</span>
                            <span class="text-muted">/year</span>
                            <div class="mt-2">
                                <span class="badge bg-success">Save Rp 7.2M</span>
                            </div>
                        </div>
                        <ul class="list-unstyled mb-4 text-start">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Everything in Professional</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Unlimited candidate views</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Custom integrations</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Dedicated account manager</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>24/7 phone support</li>
                        </ul>
                        <button class="btn btn-outline-dark w-100 btn-lg rounded-pill" onclick="alert('Contact our sales team!')">
                            <i class="fas fa-phone me-2"></i>Contact Sales
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Guarantees -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 bg-white shadow-sm">
                    <div class="card-body p-4 text-center">
                        <p class="text-muted mb-4 fw-semibold">All plans include: SSL Security, Mobile App Access, Data Export, and 99.9% Uptime Guarantee</p>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <div class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                <i class="fas fa-shield-alt me-2"></i>30-Day Money Back
                            </div>
                            <div class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                <i class="fas fa-headset me-2"></i>24/7 Support
                            </div>
                            <div class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                <i class="fas fa-sync-alt me-2"></i>Cancel Anytime
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-info text-white px-3 py-2 rounded-pill mb-3">
                <i class="fas fa-quote-left me-2"></i>Testimonials
            </span>
            <h2 class="display-6 fw-bold mb-3">What HR Leaders Say</h2>
            <p class="lead text-muted">Success stories from companies using our platform</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b647?ixlib=rb-4.0.3&auto=format&fit=crop&w=60&q=80" 
                                 class="rounded-circle me-3" width="60" height="60">
                            <div>
                                <h6 class="fw-bold mb-1">Linda Sari</h6>
                                <small class="text-muted">HR Director at PT Teknologi Maju</small>
                            </div>
                        </div>
                        <div class="mb-3 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted">"Platform ini mengubah cara kami merekrut. Kami berhasil mengurangi waktu hiring dari 3 bulan menjadi 2 minggu. Kualitas kandidat sangat baik."</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=60&q=80" 
                                 class="rounded-circle me-3" width="60" height="60">
                            <div>
                                <h6 class="fw-bold mb-1">Budi Santoso</h6>
                                <small class="text-muted">CEO at PT Digital Inovasi</small>
                            </div>
                        </div>
                        <div class="mb-3 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted">"ROI luar biasa! Biaya per hire turun 60% sejak menggunakan platform ini. Tim yang kami rekrut performanya exceptional."</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=60&q=80" 
                                 class="rounded-circle me-3" width="60" height="60">
                            <div>
                                <h6 class="fw-bold mb-1">Maya Dewi</h6>
                                <small class="text-muted">Talent Acquisition Manager</small>
                            </div>
                        </div>
                        <div class="mb-3 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted">"Dashboard analytics memberikan insight yang sangat valuable. Kami bisa track conversion rate dan optimize strategy dengan data akurat."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3 fw-bold">
                    <i class="fas fa-rocket me-2"></i>Start Your Journey
                </span>
                <h2 class="display-5 fw-bold mb-3">Ready to Transform Your Hiring?</h2>
                <p class="fs-5 mb-4 opacity-75">Join 2,500+ companies who trust us to find their best talent. Start your free trial today.</p>
                <div>
                    <a href="{{ route('register.company') }}" class="btn btn-warning btn-lg me-3 mb-3 px-5 py-3 fw-bold rounded-pill shadow-lg">
                        <i class="fas fa-rocket me-2"></i>Start Free Trial
                    </a>
                    <button class="btn btn-outline-light btn-lg mb-3 px-5 py-3 fw-bold rounded-pill" onclick="alert('Demo will be scheduled!')">
                        <i class="fas fa-play me-2"></i>Watch Demo
                    </button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="text-center">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="bg-white bg-opacity-10 rounded-4 p-4 hover-card">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <h5 class="fw-bold mb-0 counter" data-target="2500">0</h5>
                                <small>Companies</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white bg-opacity-10 rounded-4 p-4 hover-card">
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
</section>
@endsection

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
    .bg-purple {
        background-color: #8b5cf6 !important;
    }

    @keyframes float {
        0%, 100% { 
            transform: translateY(0px) rotate(0deg) scale(1); 
            opacity: 0.25;
        }
        33% { 
            transform: translateY(-25px) rotate(2deg) scale(1.1); 
            opacity: 0.3;
        }
        66% { 
            transform: translateY(-15px) rotate(-1deg) scale(0.95); 
            opacity: 0.2;
        }
    }

    @keyframes floatNotification {
        0%, 100% { 
            transform: translateY(0px) scale(1) rotate(0deg); 
            opacity: 1; 
        }
        25% { 
            transform: translateY(-20px) scale(1.05) rotate(1deg); 
            opacity: 0.9; 
        }
        50% { 
            transform: translateY(-15px) scale(1.02) rotate(-0.5deg); 
            opacity: 1; 
        }
        75% { 
            transform: translateY(-25px) scale(0.98) rotate(0.5deg); 
            opacity: 0.95; 
        }
    }

    /* Dashboard Card Enhancements */
    .dashboard-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dashboard-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
    }

    .stats-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .stats-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .candidate-item:hover {
        background-color: rgba(0, 123, 255, 0.05) !important;
        transform: translateX(5px);
    }

    .counter {
        transition: all 0.3s ease;
    }

    .floating-notification {
        pointer-events: none;
    }

    .floating-notification .card {
        pointer-events: auto;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .floating-notification .card:hover {
        transform: scale(1.08) translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25) !important;
    }

    .hover-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .hover-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 1.5rem 3rem rgba(0,0,0,.2) !important;
    }

    .btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .display-1 { font-size: 3rem; }
        .floating-notification { display: none; }
        .col-lg-4 .card[style*="transform: scale(1.05)"] {
            transform: none !important;
        }
        .dashboard-card:hover {
            transform: none;
        }
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // YouTube Demo Popup Function
    function openYouTubeDemo() {
        // Create modal structure
        const modal = document.createElement('div');
        modal.className = 'modal fade';
        modal.id = 'youtubeModal';
        modal.setAttribute('tabindex', '-1');
        modal.setAttribute('aria-labelledby', 'youtubeModalLabel');
        modal.setAttribute('aria-hidden', 'true');
        
        modal.innerHTML = `
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content bg-dark">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white" id="youtubeModalLabel">
                            <i class="fas fa-play-circle me-2"></i>Platform Demo - How JobMatch Works
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="ratio ratio-16x9">
                            <iframe 
                                src="https://www.youtube.com/embed/ScMzIvxBSi4?autoplay=1&rel=0&modestbranding=1" 
                                title="JobMatch Platform Demo" 
                                allowfullscreen
                                allow="autoplay; encrypted-media">
                            </iframe>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light">
                        <div class="w-100 text-center">
                            <p class="mb-2 text-muted small">Ready to get started with JobMatch?</p>
                            <a href="{{ route('register.company') }}" class="btn btn-primary me-2">
                                <i class="fas fa-rocket me-1"></i>Start Free Trial
                            </a>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i>Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to body
        document.body.appendChild(modal);
        
        // Initialize and show modal
        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
        
        // Remove modal from DOM when hidden
        modal.addEventListener('hidden.bs.modal', function () {
            document.body.removeChild(modal);
        });
        
        // Analytics tracking
        console.log('🎥 YouTube Demo opened - Company Homepage');
    }

    // Make function global so it can be called from onclick
    window.openYouTubeDemo = openYouTubeDemo;

    // Dashboard Counter Animation
    function animateDashboardCounter(element, target) {
        let current = 0;
        const increment = target / 30;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 50);
    }

    // Animate dashboard counters (including the card counters)
    document.querySelectorAll('.counter').forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        animateDashboardCounter(counter, target);
    });

    // Stats Counter Animation
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

    // Intersection Observer for stats
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && entry.target.classList.contains('stats-counter')) {
                const target = parseInt(entry.target.getAttribute('data-target'));
                animateCounter(entry.target, target);
                observer.unobserve(entry.target);
            }
        });
    });

    document.querySelectorAll('.stats-counter').forEach(el => observer.observe(el));

    // Pricing toggle
    const pricingSwitch = document.querySelector('#pricingSwitch');
    if (pricingSwitch) {
        pricingSwitch.addEventListener('change', function() {
            const monthlyPrices = document.querySelectorAll('.monthly-price');
            const annualPrices = document.querySelectorAll('.annual-price');
            
            if (this.checked) {
                monthlyPrices.forEach(price => price.classList.add('d-none'));
                annualPrices.forEach(price => price.classList.remove('d-none'));
            } else {
                monthlyPrices.forEach(price => price.classList.remove('d-none'));
                annualPrices.forEach(price => price.classList.add('d-none'));
            }
        });
    }

    // Enhanced Floating Notifications Interactions
    document.querySelectorAll('.floating-notification').forEach((notification, index) => {
        notification.addEventListener('click', function() {
            const title = this.querySelector('h6').textContent;
            const subtitle = this.querySelector('small').textContent;
            const timeAgo = this.querySelector('small.fw-semibold')?.textContent || '';
            
            if (title.includes('Company')) {
                alert(`🎉 ${title}!\n🏢 ${subtitle}\n⏰ ${timeAgo}\n\nWelcome to JobMatch platform!`);
            } else if (title.includes('Match')) {
                alert(`🤝 ${title}!\n💼 ${subtitle}\n⏰ ${timeAgo}\n\nCongratulations on the successful hire!`);
            } else if (title.includes('Review')) {
                alert(`⭐ ${title}!\n💬 ${subtitle}\n🕐 ${timeAgo}\n\nThank you for your excellent service!`);
            } else if (title.includes('Goal')) {
                alert(`🏆 ${title}!\n📈 ${subtitle}\n⏰ ${timeAgo}\n\nAmazing achievement!`);
            }
        });
    });

    // Enhanced hover effects for testimonial cards
    document.querySelectorAll('.hover-card').forEach(card => {
        if (card.querySelector('.fa-star')) {
            card.addEventListener('click', function() {
                const name = this.querySelector('h6')?.textContent || 'User';
                const company = this.querySelector('small')?.textContent || 'Company';
                alert(`💬 Testimoni dari ${name}\n🏢 ${company}\n\n"Terima kasih telah membaca review kami!"`);
            });
        }
    });

    // Add subtle parallax effect to background particles
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const particles = document.querySelectorAll('.position-absolute.bg-warning, .position-absolute.bg-info, .position-absolute.bg-success, .position-absolute.bg-primary, .position-absolute.bg-danger, .position-absolute.bg-purple');
        
        particles.forEach((particle, index) => {
            const speed = 0.5 + (index * 0.1);
            const yPos = -(scrolled * speed);
            particle.style.transform = `translateY(${yPos}px)`;
        });
    });

    console.log('🚀 Enhanced Company home page loaded successfully!');
});
</script>
@endsection