<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JobMatch Register</title>
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

      <p class="mb-3">Are you a applicant? <a href="{{ route('register.applicant') }}" class="text-decoration-none">Register as a applicant</a></p>

      <div class="card p-4">
        <h6 class="fw-bold">REGISTER COMPANY</h6>

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
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#companyData">
                Company Data
              </button>
            </h2>
            <div id="companyData" class="accordion-collapse collapse" data-bs-parent="#registerAccordion">
              <div class="accordion-body">
                <form action="{{ route('register.company.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- User Data Section -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    
                    <!-- Role Selection -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="applicant">Applicant</option>
                            <option value="company" selected>Company</option>
                        </select>
                    </div>

                    <div class="row g-3 align-items-start">
                    <div class="col-md-3 text-center">
                      <label for="logo" class="form-label fw-bold">Logo</label>
                      <div class="border rounded d-flex align-items-center justify-content-center" style="height: 150px;">
                        <label for="logo" class="w-100 h-100 d-flex align-items-center justify-content-center cursor-pointer">
                          <i class="bi bi-camera" style="font-size: 2rem;"></i>
                          <input type="file" class="form-control" id="logo" name="logo">
                        </label>
                      </div>
                    </div>
                
                    <div class="col-md-9">
                      <div class="mb-3">
                        <label for="company_name" class="form-label">Company name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" required placeholder="Enter your company name">
                      </div>
                      <div class="mb-3">
                        <label for="company_address" class="form-label">Company's address</label>
                        <input type="text" class="form-control" id="company_address" name="company_address" required placeholder="Enter your company address">
                      </div>
                    </div>
                  </div>
                
                    <div class="mb-3">
                        <label for="website_address" class="form-label">Website address</label>
                        <input type="text" class="form-control" id="website_address" name="website_address" required placeholder="https://yourcompany.com">
                    </div>
                    <div class="mb-3">
                        <label for="company_email" class="form-label">Company Email</label>
                        <input type="email" class="form-control" id="company_email" name="company_email" required placeholder="email@company.com">
                    </div>
                    <div class="mb-3">
                        <label for="company_phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="company_phone_number" name="company_phone_number" required placeholder="+62 81234567890">
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#jobVacancy">
                            Job Vacancy
                        </button>
                        </h2>
                        <div id="jobVacancy" class="accordion-collapse collapse" data-bs-parent="#registerAccordion">
                        <div class="accordion-body">
                            <div class="accordion-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control" id="position" name="position" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="type_of_work" class="form-label">Type of Work</label>
                                    <input type="text" class="form-control" id="type_of_work" name="type_of_work" required>
                                </div>
                                <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" required placeholder="e.g. Jakarta">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="salary_min" class="form-label">Salary Min</label>
                                    <input type="number" class="form-control" id="salary_min" name="salary_min" required placeholder="e.g. 7000000">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="salary_max" class="form-label">Salary Max</label>
                                    <input type="number" class="form-control" id="salary_max" name="salary_max" required placeholder="e.g. 10000000">
                                </div>
                                </div>                    
                            </div>

                            <label class="form-label">Deadline</label>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="date" class="form-control" id="deadline" name="deadline" required>
                            </div>

                            <div class="mb-3">
                                <label for="job_description" class="form-label">Job Description</label>
                                <textarea class="form-control" id="job_description" name="job_description" rows="3" required></textarea>
                            </div>
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
          Already have an account? <a href="{{ route('login.company') }}">Login</a>
        </div>
        </div>
      </div>
    </div>

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
            window.location.href = "{{ route('login.company') }}"; // Ganti dengan route login yang sesuai
        }, 3000); // 3000ms = 3 detik
    }
    </script>
  </body>
</html>
