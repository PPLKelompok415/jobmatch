@extends('layouts.app') {{-- Pastikan halaman ini memperluas layout utama Anda --}}

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h2 class="mb-4 fw-bold text-center">Edit Data Perusahaan</h2>

                {{-- Tampilkan pesan sukses jika ada --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Tampilkan pesan error validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Whoops! Ada Kesalahan!</strong> Mohon periksa kembali input Anda.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Form untuk mengedit data perusahaan --}}
                <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- PENTING: Gunakan metode PUT untuk update --}}

                    {{-- user_id (Hidden field karena user_id diambil dari Auth di controller) --}}
                    <input type="hidden" name="user_id" value="{{ old('user_id', $company->user_id) }}">

                    <div class="mb-3">
                        <label for="company_name" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $company->company_name) }}" required>
                        @error('company_name')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="company_address" class="form-label">Alamat Perusahaan</label>
                        <textarea class="form-control" id="company_address" name="company_address" rows="3" required>{{ old('company_address', $company->company_address) }}</textarea>
                        @error('company_address')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="website_address" class="form-label">Alamat Website</label>
                        <input type="url" class="form-control" id="website_address" name="website_address" value="{{ old('website_address', $company->website_address) }}" required>
                        @error('website_address')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="company_email" class="form-label">Email Perusahaan</label>
                        <input type="email" class="form-control" id="company_email" name="company_email" value="{{ old('company_email', $company->company_email) }}" required>
                        @error('company_email')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="company_phone_number" class="form-label">Nomor Telepon Perusahaan</label>
                        <input type="text" class="form-control" id="company_phone_number" name="company_phone_number" value="{{ old('company_phone_number', $company->company_phone_number) }}" required>
                        @error('company_phone_number')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                    
                    {{-- Kolom Job-related yang ada di tabel companies --}}
                    <div class="mb-3">
                        <label for="position" class="form-label">Posisi (Jabatan Umum)</label>
                        <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $company->position) }}" required>
                        @error('position')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="type_of_work" class="form-label">Tipe Pekerjaan</label>
                        <select class="form-select" id="type_of_work" name="type_of_work" required>
                            <option value="">Pilih Tipe Pekerjaan</option>
                            <option value="Full Time" {{ (old('type_of_work', $company->type_of_work) == 'Full Time') ? 'selected' : '' }}>Full Time</option>
                            <option value="Part Time" {{ (old('type_of_work', $company->type_of_work) == 'Part Time') ? 'selected' : '' }}>Part Time</option>
                            <option value="Remote" {{ (old('type_of_work', $company->type_of_work) == 'Remote') ? 'selected' : '' }}>Remote</option>
                            <option value="Freelance" {{ (old('type_of_work', $company->type_of_work) == 'Freelance') ? 'selected' : '' }}>Freelance</option>
                            <option value="Internship" {{ (old('type_of_work', $company->type_of_work) == 'Internship') ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('type_of_work')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi Pekerjaan</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $company->location) }}" required>
                        @error('location')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="salary_min" class="form-label">Gaji Minimum</label>
                            <input type="number" class="form-control" id="salary_min" name="salary_min" value="{{ old('salary_min', $company->salary_min) }}" required min="0">
                            @error('salary_min')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="salary_max" class="form-label">Gaji Maksimum</label>
                            <input type="number" class="form-control" id="salary_max" name="salary_max" value="{{ old('salary_max', $company->salary_max) }}" required min="0">
                            @error('salary_max')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline Lamaran</label>
                        <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline', $company->deadline ? \Carbon\Carbon::parse($company->deadline)->format('Y-m-d') : '') }}" required>
                        @error('deadline')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="job_description" class="form-label">Deskripsi Pekerjaan</label>
                        <textarea class="form-control" id="job_description" name="job_description" rows="5" required>{{ old('job_description', $company->job_description) }}</textarea>
                        @error('job_description')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Logo Perusahaan --}}
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo Perusahaan</label>
                        <input class="form-control" type="file" id="logo" name="logo">
                        @if($company->logo)
                            @php
                                $logoPath = asset('images/default_logo.png');
                                $dbLogo = $company->logo;
                                // Perbaikan di sini: Gunakan \Illuminate\Support\Str::startsWith
                                if (\Illuminate\Support\Str::startsWith($dbLogo, 'storage/') || \Illuminate\Support\Str::startsWith($dbLogo, 'http://') || \Illuminate\Support\Str::startsWith($dbLogo, 'https://')) {
                                    $logoPath = asset($dbLogo);
                                } else {
                                    $logoPath = asset('storage/' . $dbLogo);
                                }
                            @endphp
                            <small class="text-muted mt-2 d-block">Logo Saat Ini: <img src="{{ $logoPath }}" alt="Current Logo" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;"></small>
                        @endif
                        @error('logo')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Perbarui Data Perusahaan</button>
                        <a href="{{ route('jobs.index') }}" class="btn btn-secondary btn-lg">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
