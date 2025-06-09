@extends('layouts.dashboardcompany')
@section('title', 'Post Job Listing')

@section('content')
<div class="dashboard-container">
  <div class="dashboard-header">
    <h1 class="dashboard-title">Post New Job Opportunity</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('company.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Post Job</li>
      </ol>
    </nav>
  </div>

  <div class="dashboard-content">
    <div class="card job-form-card">
      <div class="card-header">
        <h2 class="card-title">Job Details</h2>
        <p class="card-subtitle">Fill in the details of your job opening</p>
      </div>
      
      <div class="card-body">
        <form action="{{ route('company.job.store') }}" method="POST" class="needs-validation" novalidate>
          @csrf

          <div class="row g-3">
            <!-- Job Title -->
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" name="title" class="form-control" id="title" placeholder="Software Engineer" required>
                <label for="title">Job Title</label>
                <div class="invalid-feedback">
                  Please provide a job title.
                </div>
              </div>
            </div>

            <!-- Job Type and Location -->
            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" name="type_of_work" id="type_of_work" required>
                  <option value="" selected disabled>Select job type</option>
                  <option value="Full-time">Full-time</option>
                  <option value="Part-time">Part-time</option>
                  <option value="Contract">Contract</option>
                  <option value="Freelance">Freelance</option>
                  <option value="Internship">Internship</option>
                </select>
                <label for="type_of_work">Employment Type</label>
                <div class="invalid-feedback">
                  Please select employment type.
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="location" class="form-control" id="location" placeholder="Jakarta, Indonesia" required>
                <label for="location">Job Location</label>
                <div class="invalid-feedback">
                  Please provide job location.
                </div>
              </div>
            </div>

            <!-- Salary Range -->
            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" name="gaji_min" class="form-control" id="gaji_min" placeholder="Minimum Salary" required>
                <label for="gaji_min">Minimum Salary (IDR)</label>
                <div class="invalid-feedback">
                  Please provide minimum salary.
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" name="gaji_max" class="form-control" id="gaji_max" placeholder="Maximum Salary" required>
                <label for="gaji_max">Maximum Salary (IDR)</label>
                <div class="invalid-feedback">
                  Please provide maximum salary.
                </div>
              </div>
            </div>

            <!-- Job Field and Description -->
            <div class="col-md-12">
              <div class="form-floating">
                <select class="form-select" name="bidang" id="bidang" required>
                  <option value="" selected disabled>Select job field</option>
                  <option value="Technology">Technology</option>
                  <option value="Finance">Finance</option>
                  <option value="Healthcare">Healthcare</option>
                  <option value="Education">Education</option>
                  <option value="Marketing">Marketing</option>
                  <option value="Design">Design</option>
                  <option value="Other">Other</option>
                </select>
                <label for="bidang">Job Field/Category</label>
                <div class="invalid-feedback">
                  Please select job field.
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control" name="description" id="description" style="height: 150px" placeholder="Job description" required></textarea>
                <label for="description">Job Description</label>
                <div class="invalid-feedback">
                  Please provide job description.
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control" name="requirements" id="requirements" style="height: 150px" placeholder="Job requirements" required></textarea>
                <label for="requirements">Job Requirements</label>
                <div class="invalid-feedback">
                  Please provide job requirements.
                </div>
              </div>
            </div>

            <!-- Form Actions -->
            <div class="col-12 mt-4">
              <div class="d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-paper-plane me-2"></i> Post Job
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
  .dashboard-container {
    background-color: #f8f9fa;
    min-height: 100vh;
    padding: 2rem;
  }

  .dashboard-header {
    margin-bottom: 2rem;
  }

  .dashboard-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  .breadcrumb {
    background-color: transparent;
    padding: 0;
    margin-bottom: 0;
  }

  .job-form-card {
    border: none;
    border-radius: 0.5rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
  }

  .card-header {
    background-color: #fff;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    padding: 1.5rem;
  }

  .card-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.25rem;
  }

  .card-subtitle {
    color: #7f8c8d;
    font-size: 0.875rem;
    margin-bottom: 0;
  }

  .card-body {
    padding: 2rem;
  }

  .form-floating {
    margin-bottom: 1.5rem;
  }

  .form-floating label {
    color: #7f8c8d;
  }

  .form-control, .form-select {
    height: calc(3.5rem + 2px);
    border-radius: 0.375rem;
    border: 1px solid #dfe7f1;
    padding: 1rem 0.75rem;
  }

  .form-control:focus, .form-select:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
  }

  textarea.form-control {
    height: auto !important;
  }

  .btn-primary {
    background-color: #3498db;
    border-color: #3498db;
    padding: 0.625rem 1.5rem;
    font-weight: 500;
  }

  .btn-primary:hover {
    background-color: #2980b9;
    border-color: #2980b9;
  }

  .btn-outline-secondary {
    padding: 0.625rem 1.5rem;
    font-weight: 500;
  }

  .invalid-feedback {
    font-size: 0.875rem;
  }

  @media (max-width: 768px) {
    .dashboard-container {
      padding: 1rem;
    }
    
    .card-body {
      padding: 1.5rem;
    }
  }
</style>
@endpush

@push('scripts')
<script>
  // Form validation
  (function () {
    'use strict'
    
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
    
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        
        form.classList.add('was-validated')
      }, false)
    })
  })()
  
  // Salary validation
  document.getElementById('gaji_max').addEventListener('change', function() {
    const minSalary = parseFloat(document.getElementById('gaji_min').value);
    const maxSalary = parseFloat(this.value);
    
    if (maxSalary < minSalary) {
      this.setCustomValidity('Maximum salary must be greater than minimum salary');
    } else {
      this.setCustomValidity('');
    }
  });
</script>
@endpush