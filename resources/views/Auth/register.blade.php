<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JobMatch-Applicant Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
      body {
        background-color: #f9fbfc;
        font-family: 'Segoe UI', sans-serif;
      }
      .logo {
        font-weight: bold;
        font-size: 20px;
        margin-left: 10px;
      }
      .language-switch {
        position: absolute;
        top: 20px;
        right: 20px;
      }
      .dropdown-toggle {
        background-color: #6c8494;
        color: white;
        border-radius: 10px;
        padding: 10px 15px;
        border: none;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
      }
      .dropdown-menu {
        min-width: 120px;
        font-size: 14px;
      }
      .accordion-button::after {
        transform: rotate(180deg);
      }
      .accordion-button.collapsed::after {
        transform: rotate(0deg);
      }
      .accordion-button {
        font-weight: bold;
        font-size: 1.5rem;
        color: #2c3e50;
        background-color: transparent;
      }
      .card {
        border: 2px solid #6c8494;
        border-radius: 12px;
      }
      .card-header {
        background-color: transparent;
        border-bottom: none;
      }
      .login-text {
        margin-top: 20px;
        text-align: left;
        font-size: 14px;
      }
      .login-text a {
        text-decoration: none;
        color: #2c3e50;
        font-weight: 500;
      }
    </style>
  </head>
  <body>
    <div class="container py-5 position-relative">
      <div class="d-flex align-items-center mb-4">
        <div class="bg-dark text-white px-2 py-1 rounded">J</div>
        <div class="logo">JOBMATCH</div>
      </div>

      <div class="language-switch dropdown">
        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-globe"></i> Language
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#">English</a></li>
          <li><a class="dropdown-item" href="#">Indonesia</a></li>
        </ul>
      </div>

      <p class="mb-3">Are you a company? <a href="{{ route('register.company') }}" class="text-decoration-none">Register as a company</a></p>

      <div class="card p-4">
        <h6 class="fw-bold">REGISTER</h6>
        <div class="card-body">
        <!-- Notifikasi Success atau Error -->
        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        @if (session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
        @endif

        <div class="accordion mt-3" id="registerAccordion">
          <div class="accordion-item border-0">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#personalData">
                Personal Data
              </button>
            </h2>
            <div id="personalData" class="accordion-collapse collapse" data-bs-parent="#registerAccordion">
              <div class="accordion-body">

                <!-- Formulir Registrasi -->
                <form action="{{ route('register.applicant.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <!-- Input Username -->
                    <div class="mb-3">
                              <label for="name" class="form-label">Username</label>
                              <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <!-- Input Password -->
                    <div class="mb-3">
                              <label for="password" class="form-label">Password</label>
                              <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <!-- Input Confirm Password -->
                    <div class="mb-3">
                              <label for="password_confirmation" class="form-label">Confirm Password</label>
                              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <!-- Input Role -->
                    <div class="mb-3">
                              <label for="role" class="form-label">Role</label>
                              <select class="form-select" id="role" name="role" required>
                              <option value="applicant" {{ old('role') == 'applicant' ? 'selected' : '' }}>Applicant</option>
                              <option value="company" {{ old('role') == 'company' ? 'selected' : '' }}>Company</option>
                              </select>
                    </div>

                    <div class="row mb-3">
                    <div class="col-md-2 text-center">
                              <label for="photo" class="form-label">Photo</label>
                              <div class="border rounded p-2">
                              <i class="bi bi-camera" style="font-size: 1.5rem;"></i>
                              <input type="file" class="form-control mt-2" id="photo" name="photo">
                    </div>
                    </div>
                    <div class="col-md-10">
                              <label for="full_name" class="form-label">Full Name</label>
                              <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                    </div>
                    </div>

                    <div class="mb-3">
                              <label for="date_of_birth" class="form-label">Date of Birth</label>
                              <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                    </div>

                    <div class="mb-3">
                              <label for="gender" class="form-label">Gender</label>
                              <select class="form-select" id="gender" name="gender" required>
                              <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                              <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                              <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                              </select>
                    </div>

                    <div class="mb-3">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required placeholder="example@email.com">
                    </div>

                    <div class="mb-3">
                              <label for="phone_number" class="form-label">Phone Number</label>
                              <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required placeholder="+62 812 3456 7890">
                    </div>

                    <div class="mb-3">
                              <label for="address" class="form-label">Address</label>
                              <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                    </div>

                    <div class="mb-3">
                              <label for="cv_file" class="form-label">CV</label>
                              <input type="file" class="form-control" id="cv_file" name="cv_file">
                    </div>

                    <div class="mb-3">
                              <label for="portfolio_file" class="form-label">Portfolio</label>
                              <input type="file" class="form-control" id="portfolio_file" name="portfolio_file">
                    </div>
                    </div>
                    </div>
                    </div>

                    <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#experienceEducation">
                              Experience & Education
                    </button>
                    </h2>
                    <div id="experienceEducation" class="accordion-collapse collapse" data-bs-parent="#registerAccordion">
                    <div class="accordion-body">
                    <h6><strong>Education</strong></h6>
                    <div class="row mb-3">
                    <div class="col-md-4">
                              <label for="institution" class="form-label">Institution</label>
                              <input type="text" class="form-control" id="institution" name="institution" value="{{ old('institution') }}">
                    </div>
                    <div class="col-md-4">
                              <label for="major" class="form-label">Major</label>
                              <input type="text" class="form-control" id="major" name="major" value="{{ old('major') }}">
                    </div>
                    <div class="col-md-4">
                              <label for="graduation_year" class="form-label">Graduation Year</label>
                              <input type="number" class="form-control" id="graduation_year" name="graduation_year" value="{{ old('graduation_year') }}" placeholder="e.g. 2024">
                    </div>
                    </div>

                    <h6><strong>Work Experience</strong></h6>
                    <div class="row mb-3">
                    <div class="col-md-4">
                              <label for="work_company" class="form-label">Work Company</label>
                              <input type="text" class="form-control" id="work_company" name="work_company" value="{{ old('work_company') }}">
                    </div>
                    <div class="col-md-4">
                              <label for="work_position" class="form-label">Work Position</label>
                              <input type="text" class="form-control" id="work_position" name="work_position" value="{{ old('work_position') }}">
                    </div>
                    <!-- <div class="col-md-4">
                              <label for="work_period" class="form-label">Working Period</label>
                              <input type="text" class="form-control" id="work_period" name="work_period" placeholder="e.g. Jan 2022 - Dec 2023">
                    </div> -->
                    </div>
                    <div class="mb-3">
                              <label for="work_description" class="form-label">Work Description</label>
                              <textarea class="form-control" id="work_description" name="work_description" rows="3">{{ old('work_description') }}</textarea>
                    </div>

                    <div class="mb-3">
                    <label for="soft_skills" class="form-label">Soft Skills</label>
                    <input type="text" class="form-control" id="soft_skills" name="soft_skills" value="{{ old('soft_skills') }}">
                    </div>

                    <div class="mb-3">
                              <label for="hard_skills" class="form-label">Hard Skills</label>
                              <input type="text" class="form-control" id="hard_skills" name="hard_skills" value="{{ old('hard_skills') }}">
                    </div>

                    <div class="mb-3">
                              <label for="certification" class="form-label">Certification (Upload File)</label>
                              <input type="file" class="form-control" id="certification" name="certification">
                    </div>
                    </div>
                    </div>
                    </div>

                    <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#desiredJob">
                    Desired Job
                    </button>
                    </h2>
                    <div id="desiredJob" class="accordion-collapse collapse" data-bs-parent="#registerAccordion">
                    <div class="accordion-body">
                    <div class="mb-3">
                              <label for="desired_position" class="form-label">Desired Job Position</label>
                              <input type="text" class="form-control" id="desired_position" name="desired_position" value="{{ old('desired_position') }}" required placeholder="e.g. Frontend Developer">
                    </div>

                    <div class="mb-3">
                    <label for="type_of_work" class="form-label">Type of Work (Full Time/ Partime/ WFH)</label>
                    <input type="text" class="form-control" id="type_of_work" name="type_of_work" value="{{ old('type_of_work') }}" required>
                </div>

                    <div class="row">
                    <div class="col-md-6 mb-3">
                              <label for="location" class="form-label">Location</label>
                              <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required placeholder="e.g. Jakarta">
                    </div>
                    <div class="col-md-3 mb-3">
                              <label for="salary_min" class="form-label">Salary Min</label>
                              <input type="number" class="form-control" id="salary_min" name="salary_min" value="{{ old('salary_min') }}" required placeholder="e.g. 7000000">
                    </div>
                    <div class="col-md-3 mb-3">
                              <label for="salary_max" class="form-label">Salary Max</label>
                              <input type="number" class="form-control" id="salary_max" name="salary_max" value="{{ old('salary_max') }}" required placeholder="e.g. 10000000">
                    </div>
                    </div>
                    
                    <div class="mb-3">
                              <label for="availability_date" class="form-label">Availability Date</label>
                              <input type="date" class="form-control" id="availability_date" name="availability_date" value="{{ old('availability_date') }}" required>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                              <button class="btn btn-secondary btn-lg" type="submit">Register</button>
                    </div>
                </form>

        <div class="login-text">
          Already have an account? <a href="{{ route('login.applicant') }}">Login</a>
        </div>
      </div>
    </div>

    <!-- java script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('role').addEventListener('change', function () {
        var role = this.value;
        if (role === 'company') {
            document.getElementById('company').style.display = 'block';
        } else {
            document.getElementById('company').style.display = 'none';
        }
      });
      // JavaScript untuk pengecekan dan redirect jika registrasi berhasil
      var successMessage = document.getElementById('success-message');
      if (successMessage) {
        // Jika registrasi sukses, arahkan ke halaman login setelah 3 detik
        setTimeout(function() {
          window.location.href = "{{ route('login.applicant') }}"; // Ganti dengan route login yang sesuai
        }, 3000); // 3000ms = 3 detik
      }
    </script>

  </body>
</html>
