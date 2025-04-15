@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">Register for JobMatch</div>
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

                <!-- Personal Data -->
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo">
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
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
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

                <!-- Education & Experience -->
                <div class="mb-3">
                    <label for="institution" class="form-label">Institution</label>
                    <input type="text" class="form-control" id="institution" name="institution" value="{{ old('institution') }}">
                </div>

                <div class="mb-3">
                    <label for="major" class="form-label">Major</label>
                    <input type="text" class="form-control" id="major" name="major" value="{{ old('major') }}">
                </div>

                <div class="mb-3">
                    <label for="graduation_year" class="form-label">Graduation Year</label>
                    <input type="number" class="form-control" id="graduation_year" name="graduation_year" value="{{ old('graduation_year') }}">
                </div>

                <div class="mb-3">
                    <label for="work_company" class="form-label">Work Company</label>
                    <input type="text" class="form-control" id="work_company" name="work_company" value="{{ old('work_company') }}">
                </div>

                <div class="mb-3">
                    <label for="work_position" class="form-label">Work Position</label>
                    <input type="text" class="form-control" id="work_position" name="work_position" value="{{ old('work_position') }}">
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
                    <label for="certification" class="form-label">Certification</label>
                    <input type="file" class="form-control" id="certification" name="certification">
                </div>

                <!-- Desired Job -->
                <div class="mb-3">
                    <label for="desired_position" class="form-label">Desired Position</label>
                    <input type="text" class="form-control" id="desired_position" name="desired_position" value="{{ old('desired_position') }}" required>
                </div>

                <div class="mb-3">
                    <label for="type_of_work" class="form-label">Type of Work</label>
                    <input type="text" class="form-control" id="type_of_work" name="type_of_work" value="{{ old('type_of_work') }}" required>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                </div>

                <div class="mb-3">
                    <label for="salary_min" class="form-label">Salary Min</label>
                    <input type="number" class="form-control" id="salary_min" name="salary_min" value="{{ old('salary_min') }}" required>
                </div>

                <div class="mb-3">
                    <label for="salary_max" class="form-label">Salary Max</label>
                    <input type="number" class="form-control" id="salary_max" name="salary_max" value="{{ old('salary_max') }}" required>
                </div>

                <div class="mb-3">
                    <label for="availability_date" class="form-label">Availability Date</label>
                    <input type="date" class="form-control" id="availability_date" name="availability_date" value="{{ old('availability_date') }}" required>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Register</button>
            </form>

            </div>
        </div>
    </div>
</div>

@endsection
