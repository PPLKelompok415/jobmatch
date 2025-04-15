@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">Register for JobMatch</div>
            <div class="card-body">
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

                <form action="{{ route('register.company.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Role Selection -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="employee">Employee</option>
                            <option value="company">Company</option>
                        </select>
                    </div>

                    <!-- Company Data Section -->
                    <div id="companyData" style="display:none;">
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                        </div>
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="company_address" class="form-label">Company Address</label>
                            <input type="text" class="form-control" id="company_address" name="company_address" required>
                        </div>
                        <div class="mb-3">
                            <label for="website_address" class="form-label">Website Address</label>
                            <input type="text" class="form-control" id="website_address" name="website_address" required>
                        </div>
                        <div class="mb-3">
                            <label for="company_email" class="form-label">Company Email</label>
                            <input type="email" class="form-control" id="company_email" name="company_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="company_phone_number" class="form-label">Company Phone Number</label>
                            <input type="text" class="form-control" id="company_phone_number" name="company_phone_number" required>
                        </div>

                        <!-- Job Vacancy -->
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" name="position" required>
                        </div>
                        <div class="mb-3">
                            <label for="type_of_work" class="form-label">Type of Work</label>
                            <input type="text" class="form-control" id="type_of_work" name="type_of_work" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="mb-3">
                            <label for="salary_min" class="form-label">Salary Min</label>
                            <input type="number" class="form-control" id="salary_min" name="salary_min" required>
                        </div>
                        <div class="mb-3">
                            <label for="salary_max" class="form-label">Salary Max</label>
                            <input type="number" class="form-control" id="salary_max" name="salary_max" required>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="deadline" name="deadline" required>
                        </div>
                        <div class="mb-3">
                            <label for="job_description" class="form-label">Job Description</label>
                            <textarea class="form-control" id="job_description" name="job_description" rows="3" required></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('role').addEventListener('change', function () {
        var role = this.value;
        if (role === 'company') {
            document.getElementById('companyData').style.display = 'block';
        } else {
            document.getElementById('companyData').style.display = 'none';
        }
    });
</script>
@endsection
