<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JobMatch - Company Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }
        
        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
            padding: 2rem;
            max-width: 900px;
        }
        
        .logo {
            font-weight: bold;
            font-size: 20px;
            margin-left: 10px;
            color: #e67e22;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .logo-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #e67e22 0%, #f39c12 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }
        
        .language-switch {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        
        .dropdown-toggle {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 10px;
            padding: 10px 15px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
            backdrop-filter: blur(10px);
        }
        
        .dropdown-menu {
            min-width: 120px;
            font-size: 14px;
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .accordion-button {
            font-weight: bold;
            font-size: 1.25rem;
            color: #2c3e50;
            background: linear-gradient(135deg, rgba(230, 126, 34, 0.1) 0%, rgba(243, 156, 18, 0.1) 100%);
            border: 1px solid rgba(230, 126, 34, 0.2);
            border-radius: 12px !important;
            margin-bottom: 1rem;
        }
        
        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, rgba(230, 126, 34, 0.2) 0%, rgba(243, 156, 18, 0.2) 100%);
            color: #e67e22;
        }
        
        .accordion-button::after {
            transform: rotate(180deg);
            color: #e67e22;
        }
        
        .accordion-button.collapsed::after {
            transform: rotate(0deg);
        }
        
        .accordion-item {
            border: none;
            margin-bottom: 1rem;
        }
        
        .accordion-body {
            background: white;
            border-radius: 0 0 12px 12px;
            padding: 2rem;
        }
        
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background: transparent;
            border-bottom: none;
            padding: 1.5rem 2rem 0;
        }
        
        .form-control, .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #e67e22;
            box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.15);
        }
        
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #ef4444;
            background-color: rgba(254, 202, 202, 0.1);
        }
        
        .form-control.is-valid, .form-select.is-valid {
            border-color: #10b981;
            background-color: rgba(209, 250, 229, 0.1);
        }
        
        .invalid-feedback {
            display: block;
            font-size: 0.875rem;
            color: #ef4444;
            margin-top: 0.5rem;
            font-weight: 500;
        }
        
        .valid-feedback {
            display: block;
            font-size: 0.875rem;
            color: #10b981;
            margin-top: 0.5rem;
            font-weight: 500;
        }
        
        .logo-upload {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8fafc;
            flex-direction: column;
        }
        
        .logo-upload:hover {
            border-color: #e67e22;
            background: rgba(230, 126, 34, 0.05);
        }
        
        .logo-upload.dragover {
            border-color: #e67e22;
            background: rgba(230, 126, 34, 0.1);
        }
        
        .logo-preview {
            max-width: 120px;
            max-height: 120px;
            border-radius: 8px;
            margin-top: 0.5rem;
        }
        
        .btn-register {
            background: linear-gradient(135deg, #e67e22 0%, #f39c12 100%);
            border: none;
            border-radius: 15px;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(230, 126, 34, 0.3);
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(230, 126, 34, 0.4);
            color: white;
        }
        
        .btn-register:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .loading-spinner {
            display: none;
            margin-left: 0.5rem;
        }
        
        .progress-bar-custom {
            height: 6px;
            background: linear-gradient(135deg, #e67e22 0%, #f39c12 100%);
            border-radius: 3px;
            margin-bottom: 2rem;
        }
        
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
        }
        
        .step-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: #6b7280;
        }
        
        .step-item.active {
            color: #e67e22;
            font-weight: 600;
        }
        
        .step-item.completed {
            color: #10b981;
        }
        
        .step-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }
        
        .step-item.active .step-icon {
            background: #e67e22;
            color: white;
        }
        
        .step-item.completed .step-icon {
            background: #10b981;
            color: white;
        }
        
        .login-text {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.95rem;
            color: #6b7280;
        }
        
        .login-text a {
            text-decoration: none;
            color: #e67e22;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .login-text a:hover {
            color: #d35400;
        }
        
        /* Toast Notifications */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1055;
        }
        
        .toast {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            min-width: 300px;
        }
        
        .toast-success {
            border-left: 4px solid #10b981;
        }
        
        .toast-error {
            border-left: 4px solid #ef4444;
        }
        
        .toast-warning {
            border-left: 4px solid #f59e0b;
        }
        
        .toast-info {
            border-left: 4px solid #e67e22;
        }
        
        /* Field Requirements */
        .field-requirements {
            font-size: 0.8rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }
        
        .requirement-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-bottom: 0.25rem;
        }
        
        .requirement-item.met {
            color: #10b981;
        }
        
        .requirement-item.unmet {
            color: #ef4444;
        }
        
        /* File Upload Styles */
        .file-upload-info {
            background: #fef7ed;
            border: 1px solid #fed7aa;
            border-radius: 8px;
            padding: 0.75rem;
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: #c2410c;
        }
        
        .file-size-limit {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }
        
        /* Salary Input Styling */
        .salary-input-group {
            position: relative;
        }
        
        .salary-input-group .form-control {
            padding-left: 3rem;
        }
        
        .salary-currency {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-weight: 600;
            z-index: 3;
        }
        
        @media (max-width: 768px) {
            .main-container {
                margin: 1rem;
                padding: 1.5rem;
            }
            
            .language-switch {
                position: relative;
                top: auto;
                right: auto;
                margin-bottom: 1rem;
                text-align: center;
            }
            
            .step-indicator {
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
            }
        }
        
        /* Company Theme Colors */
        .company-theme {
            --primary-color: #e67e22;
            --primary-dark: #d35400;
        }
        
        .company-switch-link {
            text-align: center;
            margin-bottom: 2rem;
            padding: 1rem;
            background: rgba(230, 126, 34, 0.1);
            border-radius: 12px;
            border: 1px solid rgba(230, 126, 34, 0.2);
        }
        
        .company-switch-link a {
            color: #e67e22;
            text-decoration: none;
            font-weight: 600;
        }
        
        .company-switch-link a:hover {
            color: #d35400;
        }
    </style>
</head>
<body>
    <div class="container py-3 position-relative">
        <!-- Language Switch -->
        <div class="language-switch dropdown">
            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-globe"></i> Language
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">English</a></li>
                <li><a class="dropdown-item" href="#">Indonesia</a></li>
            </ul>
        </div>
        
        <div class="main-container">
            <!-- Logo -->
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="logo">JOBMATCH</div>
            </div>
            
            <!-- Applicant Switch Link -->
            <div class="company-switch-link">
                <small>
                    Looking for jobs? 
                    <a href="{{ route('register.applicant') }}">Register as an applicant</a>
                </small>
            </div>
            
            <!-- Header -->
            <div class="card">
                <div class="card-header">
                    <h4 class="fw-bold mb-3" style="color: #2c3e50;">
                        <i class="fas fa-building me-2" style="color: #e67e22;"></i>
                        REGISTER YOUR COMPANY
                    </h4>
                    
                    <!-- Progress Indicator -->
                    <div class="step-indicator">
                        <div class="step-item active" id="step-company">
                            <div class="step-icon">1</div>
                            <span>Company Data</span>
                        </div>
                        <div class="step-item" id="step-job">
                            <div class="step-icon">2</div>
                            <span>Job Vacancy</span>
                        </div>
                    </div>
                    
                    <div class="progress mb-3">
                        <div class="progress-bar progress-bar-custom" id="progressBar" style="width: 50%"></div>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Alert Messages -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Success!</strong> {{ session('success') }}
                            @if(session('message'))
                                <br><small>{{ session('message') }}</small>
                            @endif
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Error!</strong> {{ session('error') }}
                            @if(session('details'))
                                <br><small>{{ session('details') }}</small>
                            @endif
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Please check your input:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <!-- Registration Form -->
                    <form action="{{ route('register.company.post') }}" method="POST" enctype="multipart/form-data" id="registrationForm" novalidate>
                        @csrf
                        
                        <!-- Hidden Role Field -->
                        <input type="hidden" name="role" value="company">
                        
                        <div class="accordion" id="registerAccordion">
                            <!-- Company Data Section -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#companyData" data-step="1">
                                        <i class="fas fa-building me-2"></i>Company Data
                                    </button>
                                </h2>
                                <div id="companyData" class="accordion-collapse collapse show" data-bs-parent="#registerAccordion">
                                    <div class="accordion-body">
                                        <!-- Account Creation -->
                                        <h6 class="fw-bold mb-3">
                                            <i class="fas fa-user-cog me-2 text-info"></i>Account Information
                                        </h6>
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="name" class="form-label">
                                                    Username <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                       id="name" name="name" value="{{ old('name') }}" required
                                                       data-validation="username">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">
                                                    Account Email <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                       id="email" name="email" value="{{ old('email') }}" required
                                                       data-validation="email">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">
                                                    Password <span class="text-danger">*</span>
                                                </label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                           id="password" name="password" required
                                                           data-validation="password">
                                                    <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y" 
                                                            onclick="togglePassword('password')" style="border: none; background: none;">
                                                        <i class="fas fa-eye" id="passwordIcon"></i>
                                                    </button>
                                                </div>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="field-requirements">
                                                    <div class="requirement-item" data-req="min-length">
                                                        <i class="fas fa-circle"></i> Minimal 8 karakter
                                                    </div>
                                                    <div class="requirement-item" data-req="uppercase">
                                                        <i class="fas fa-circle"></i> Minimal 1 huruf besar
                                                    </div>
                                                    <div class="requirement-item" data-req="number">
                                                        <i class="fas fa-circle"></i> Minimal 1 angka
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password_confirmation" class="form-label">
                                                    Confirm Password <span class="text-danger">*</span>
                                                </label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                                           id="password_confirmation" name="password_confirmation" required
                                                           data-validation="password-confirm">
                                                    <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y" 
                                                            onclick="togglePassword('password_confirmation')" style="border: none; background: none;">
                                                        <i class="fas fa-eye" id="passwordConfirmationIcon"></i>
                                                    </button>
                                                </div>
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <!-- Company Information -->
                                        <h6 class="fw-bold mb-3">
                                            <i class="fas fa-building me-2" style="color: #e67e22;"></i>Company Information
                                        </h6>
                                        
                                        <!-- Logo Upload -->
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label for="logo" class="form-label">Company Logo</label>
                                                <div class="logo-upload" onclick="document.getElementById('logo').click()">
                                                    <i class="fas fa-image mb-2" style="font-size: 2rem; color: #6b7280;"></i>
                                                    <p class="mb-0 text-center">Click to upload logo</p>
                                                    <small class="text-muted">JPG, PNG, GIF (Max: 2MB)</small>
                                                </div>
                                                <input type="file" class="form-control d-none @error('logo') is-invalid @enderror" 
                                                       id="logo" name="logo" accept="image/*"
                                                       onchange="previewImage(this, 'logoPreview')">
                                                <img id="logoPreview" class="logo-preview" style="display: none;">
                                                @error('logo')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <label for="company_name" class="form-label">
                                                            Company Name <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control @error('company_name') is-invalid @enderror" 
                                                               id="company_name" name="company_name" value="{{ old('company_name') }}" required
                                                               placeholder="PT. Your Company Name">
                                                        @error('company_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="company_address" class="form-label">
                                                            Company Address <span class="text-danger">*</span>
                                                        </label>
                                                        <textarea class="form-control @error('company_address') is-invalid @enderror" 
                                                                  id="company_address" name="company_address" rows="3" required 
                                                                  placeholder="Enter complete company address">{{ old('company_address') }}</textarea>
                                                        @error('company_address')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Contact Information -->
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="website_address" class="form-label">
                                                    Website <span class="text-danger">*</span>
                                                </label>
                                                <input type="url" class="form-control @error('website_address') is-invalid @enderror" 
                                                       id="website_address" name="website_address" value="{{ old('website_address') }}" required
                                                       placeholder="https://yourcompany.com">
                                                @error('website_address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="company_email" class="form-label">
                                                    Company Email <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" class="form-control @error('company_email') is-invalid @enderror" 
                                                       id="company_email" name="company_email" value="{{ old('company_email') }}" required
                                                       placeholder="contact@yourcompany.com">
                                                @error('company_email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="file-size-limit">Must be different from account email</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="company_phone_number" class="form-label">
                                                    Phone Number <span class="text-danger">*</span>
                                                </label>
                                                <input type="tel" class="form-control @error('company_phone_number') is-invalid @enderror" 
                                                       id="company_phone_number" name="company_phone_number" value="{{ old('company_phone_number') }}" required
                                                       placeholder="+62 21 1234 5678">
                                                @error('company_phone_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Job Vacancy Section -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#jobVacancy" data-step="2">
                                        <i class="fas fa-briefcase me-2"></i>Job Vacancy
                                    </button>
                                </h2>
                                <div id="jobVacancy" class="accordion-collapse collapse" data-bs-parent="#registerAccordion">
                                    <div class="accordion-body">
                                        <h6 class="fw-bold mb-3">
                                            <i class="fas fa-plus-circle me-2 text-success"></i>Create Your First Job Posting
                                        </h6>
                                        
                                        <!-- Position -->
                                        <div class="mb-3">
                                            <label for="position" class="form-label">
                                                Job Position <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('position') is-invalid @enderror" 
                                                   id="position" name="position" value="{{ old('position') }}" required
                                                   placeholder="e.g. Senior Software Engineer">
                                            @error('position')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <!-- Work Details -->
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="type_of_work" class="form-label">
                                                    Work Type <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-select @error('type_of_work') is-invalid @enderror" 
                                                        id="type_of_work" name="type_of_work" required>
                                                    <option value="">Select Work Type</option>
                                                    <option value="Full Time" {{ old('type_of_work') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                                    <option value="Part Time" {{ old('type_of_work') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                                    <option value="Contract" {{ old('type_of_work') == 'Contract' ? 'selected' : '' }}>Contract</option>
                                                    <option value="Internship" {{ old('type_of_work') == 'Internship' ? 'selected' : '' }}>Internship</option>
                                                    <option value="Remote" {{ old('type_of_work') == 'Remote' ? 'selected' : '' }}>Remote</option>
                                                </select>
                                                @error('type_of_work')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="location" class="form-label">
                                                    Job Location <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                                       id="location" name="location" value="{{ old('location') }}" required
                                                       placeholder="e.g. Jakarta, Indonesia">
                                                @error('location')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="deadline" class="form-label">
                                                    Application Deadline <span class="text-danger">*</span>
                                                </label>
                                                <input type="date" class="form-control @error('deadline') is-invalid @enderror" 
                                                       id="deadline" name="deadline" value="{{ old('deadline') }}" required
                                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                                @error('deadline')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <!-- Salary Range -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="salary_min" class="form-label">
                                                    Minimum Salary <span class="text-danger">*</span>
                                                </label>
                                                <div class="salary-input-group">
                                                    <span class="salary-currency">Rp</span>
                                                    <input type="number" class="form-control @error('salary_min') is-invalid @enderror" 
                                                           id="salary_min" name="salary_min" value="{{ old('salary_min') }}" required
                                                           placeholder="5000000" min="1000000">
                                                    @error('salary_min')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="file-size-limit">Minimum Rp 1.000.000</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="salary_max" class="form-label">
                                                    Maximum Salary <span class="text-danger">*</span>
                                                </label>
                                                <div class="salary-input-group">
                                                    <span class="salary-currency">Rp</span>
                                                    <input type="number" class="form-control @error('salary_max') is-invalid @enderror" 
                                                           id="salary_max" name="salary_max" value="{{ old('salary_max') }}" required
                                                           placeholder="10000000" min="1000000">
                                                    @error('salary_max')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Job Description -->
                                        <div class="mb-3">
                                            <label for="job_description" class="form-label">
                                                Job Description <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control @error('job_description') is-invalid @enderror" 
                                                      id="job_description" name="job_description" rows="6" required 
                                                      placeholder="Describe the job responsibilities, requirements, and benefits...">{{ old('job_description') }}</textarea>
                                            @error('job_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="file-size-limit">Minimum 50 characters, maximum 2000 characters</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="d-grid gap-2 mt-4">
                            <button class="btn btn-register" type="submit" id="submitButton">
                                <i class="fas fa-building me-2"></i>
                                <span id="submitText">Register Company</span>
                                <div class="loading-spinner">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Login Link -->
                    <div class="login-text">
                        Already have an account? 
                        <a href="{{ route('login.company') }}">Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Global variables
        let currentStep = 1;
        const totalSteps = 2;
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initializeValidation();
            initializeAccordion();
            updateProgress();
            
            // Auto-dismiss alerts after 5 seconds
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    if (alert.querySelector('.btn-close')) {
                        alert.querySelector('.btn-close').click();
                    }
                });
            }, 5000);
        });
        
        // Real-time validation
        function initializeValidation() {
            const form = document.getElementById('registrationForm');
            const inputs = form.querySelectorAll('input, select, textarea');
            
            inputs.forEach(input => {
                input.addEventListener('blur', () => validateField(input));
                input.addEventListener('input', () => {
                    if (input.classList.contains('is-invalid')) {
                        validateField(input);
                    }
                });
            });
        }
        
        // Validate individual field
        function validateField(field) {
            const validationType = field.getAttribute('data-validation');
            let isValid = true;
            
            // Clear previous validation
            field.classList.remove('is-valid', 'is-invalid');
            
            switch(validationType) {
                case 'username':
                    isValid = validateUsername(field.value);
                    break;
                case 'email':
                    isValid = validateEmail(field.value);
                    break;
                case 'password':
                    isValid = validatePassword(field.value);
                    updatePasswordRequirements(field.value);
                    break;
                case 'password-confirm':
                    isValid = validatePasswordConfirm(field.value);
                    break;
            }
            
            if (field.required && !field.value.trim()) {
                isValid = false;
            }
            
            if (isValid && field.value.trim()) {
                field.classList.add('is-valid');
            } else if (!isValid && field.value.trim()) {
                field.classList.add('is-invalid');
            }
        }
        
        // Validation functions
        function validateUsername(username) {
            return username.length >= 3 && username.length <= 255;
        }
        
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
        
        function validatePassword(password) {
            return password.length >= 8 && 
                   /[A-Z]/.test(password) && 
                   /\d/.test(password);
        }
        
        function validatePasswordConfirm(confirmPassword) {
            const password = document.getElementById('password').value;
            return password === confirmPassword && password.length > 0;
        }
        
        // Update password requirements display
        function updatePasswordRequirements(password) {
            const requirements = document.querySelectorAll('[data-req]');
            
            requirements.forEach(req => {
                const type = req.getAttribute('data-req');
                let met = false;
                
                switch(type) {
                    case 'min-length':
                        met = password.length >= 8;
                        break;
                    case 'uppercase':
                        met = /[A-Z]/.test(password);
                        break;
                    case 'number':
                        met = /\d/.test(password);
                        break;
                }
                
                req.className = `requirement-item ${met ? 'met' : 'unmet'}`;
                req.querySelector('i').className = `fas ${met ? 'fa-check-circle' : 'fa-circle'}`;
            });
        }
        
        // Accordion and progress handling
        function initializeAccordion() {
            const accordionButtons = document.querySelectorAll('[data-bs-toggle="collapse"]');
            
            accordionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const step = parseInt(this.getAttribute('data-step'));
                    if (step) {
                        currentStep = step;
                        updateProgress();
                        updateStepIndicators();
                    }
                });
            });
        }
        
        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progressBar').style.width = progress + '%';
        }
        
        function updateStepIndicators() {
            document.querySelectorAll('.step-item').forEach((item, index) => {
                const stepNumber = index + 1;
                item.classList.remove('active', 'completed');
                
                if (stepNumber < currentStep) {
                    item.classList.add('completed');
                    item.querySelector('.step-icon').innerHTML = '<i class="fas fa-check"></i>';
                } else if (stepNumber === currentStep) {
                    item.classList.add('active');
                    item.querySelector('.step-icon').textContent = stepNumber;
                } else {
                    item.querySelector('.step-icon').textContent = stepNumber;
                }
            });
        }
        
        // Form submission
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const submitButton = document.getElementById('submitButton');
            const submitText = document.getElementById('submitText');
            const loadingSpinner = document.querySelector('.loading-spinner');
            
            // Show loading state
            submitButton.disabled = true;
            submitText.textContent = 'Creating Company Account...';
            loadingSpinner.style.display = 'inline-block';
            
            // Validate all required fields
            const requiredFields = this.querySelectorAll('[required]');
            let hasErrors = false;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    hasErrors = true;
                }
            });
            
            if (hasErrors) {
                e.preventDefault();
                submitButton.disabled = false;
                submitText.textContent = 'Register Company';
                loadingSpinner.style.display = 'none';
                
                showToast('Please fill in all required fields', 'error');
                return;
            }
        });
        
        // Utility functions
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + 'Icon');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];
            
            if (file) {
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    showToast('File size must be less than 2MB', 'error');
                    input.value = '';
                    return;
                }
                
                // Validate file type
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    showToast('Please select a valid image file (JPG, PNG, GIF)', 'error');
                    input.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
                
                input.classList.add('is-valid');
                showToast('Logo uploaded successfully', 'success');
            }
        }
        
        // Toast notifications
        function showToast(message, type = 'info') {
            const toastContainer = document.getElementById('toastContainer');
            const toastId = 'toast-' + Date.now();
            
            const toastHtml = `
                <div id="${toastId}" class="toast toast-${type}" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="fas ${getToastIcon(type)} me-2"></i>
                        <strong class="me-auto">${getToastTitle(type)}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        ${message}
                    </div>
                </div>
            `;
            
            toastContainer.insertAdjacentHTML('beforeend', toastHtml);
            
            const toastElement = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastElement, { autohide: true, delay: 5000 });
            toast.show();
            
            // Remove toast element after it's hidden
            toastElement.addEventListener('hidden.bs.toast', function() {
                this.remove();
            });
        }
        
        function getToastIcon(type) {
            const icons = {
                'success': 'fa-check-circle',
                'error': 'fa-exclamation-triangle',
                'warning': 'fa-exclamation-circle',
                'info': 'fa-info-circle'
            };
            return icons[type] || icons.info;
        }
        
        function getToastTitle(type) {
            const titles = {
                'success': 'Success',
                'error': 'Error',
                'warning': 'Warning',
                'info': 'Information'
            };
            return titles[type] || titles.info;
        }
        
        // Salary validation
        document.getElementById('salary_min').addEventListener('input', function() {
            const salaryMax = document.getElementById('salary_max');
            if (this.value && salaryMax.value) {
                if (parseInt(this.value) > parseInt(salaryMax.value)) {
                    salaryMax.setCustomValidity('Maximum salary must be greater than minimum salary');
                } else {
                    salaryMax.setCustomValidity('');
                }
            }
        });
        
        document.getElementById('salary_max').addEventListener('input', function() {
            const salaryMin = document.getElementById('salary_min');
            if (this.value && salaryMin.value) {
                if (parseInt(this.value) < parseInt(salaryMin.value)) {
                    this.setCustomValidity('Maximum salary must be greater than minimum salary');
                } else {
                    this.setCustomValidity('');
                }
            }
        });
        
        // Email validation (different emails)
        document.getElementById('company_email').addEventListener('blur', function() {
            const accountEmail = document.getElementById('email').value;
            if (this.value && accountEmail && this.value === accountEmail) {
                this.setCustomValidity('Company email must be different from account email');
                this.classList.add('is-invalid');
                showToast('Company email must be different from account email', 'warning');
            } else {
                this.setCustomValidity('');
                if (this.value && validateEmail(this.value)) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            }
        });
        
        // Website URL validation
        document.getElementById('website_address').addEventListener('blur', function() {
            if (this.value && !this.value.startsWith('http://') && !this.value.startsWith('https://')) {
                this.value = 'https://' + this.value;
            }
        });
        
        // Character counter for job description
        document.getElementById('job_description').addEventListener('input', function() {
            const maxLength = 2000;
            const currentLength = this.value.length;
            const remaining = maxLength - currentLength;
            
            let counterElement = document.getElementById('descriptionCounter');
            if (!counterElement) {
                counterElement = document.createElement('div');
                counterElement.id = 'descriptionCounter';
                counterElement.className = 'file-size-limit';
                this.parentNode.appendChild(counterElement);
            }
            
            counterElement.textContent = `${currentLength}/${maxLength} characters`;
            
            if (remaining < 100) {
                counterElement.style.color = '#ef4444';
            } else {
                counterElement.style.color = '#6b7280';
            }
        });
        
        // Show success message and redirect
        @if(session('success'))
            showToast('{{ session('success') }}', 'success');
            setTimeout(() => {
                window.location.href = '{{ route('login.company') }}';
            }, 3000);
        @endif
        
        @if(session('error'))
            showToast('{{ session('error') }}', 'error');
        @endif
    </script>
</body>
</html>