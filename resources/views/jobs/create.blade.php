@extends('layouts.dashboardcompany')

@section('title', 'Post New Job')

@section('content')
    <main class="dashboard-content px-4 py-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5 mb-0">Post New Job Position</h2>
            {{-- Tombol kembali ke dashboard perusahaan --}}
            <a href="{{ route('company.dashboard') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        {{-- Pesan sukses atau error dari session --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Whoops! Ada beberapa masalah dengan input Anda.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-modern p-4">
            <div class="card-body">
                {{-- Form untuk membuat lowongan pekerjaan baru --}}
                <form action="{{ route('company.job.store') }}" method="POST">
                    @csrf {{-- Token CSRF untuk keamanan Laravel --}}

                    {{-- HIDDEN INPUT UNTUK COMPANY_ID --}}
                    {{-- Pastikan user login dan memiliki relasi company --}}
                    @if(Auth::check() && Auth::user()->company)
                        <input type="hidden" name="company_id" value="{{ Auth::user()->company->id }}">
                    @else
                        {{-- Opsional: Tampilkan pesan error atau redirect jika tidak ada perusahaan terkait --}}
                        <div class="alert alert-danger">Profil perusahaan tidak ditemukan. Anda tidak dapat memposting lowongan.</div>
                    @endif
                    {{-- END HIDDEN INPUT --}}

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Pekerjaan</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                        @error('location')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="bidang" class="form-label">Bidang Industri</label>
                        <input type="text" class="form-control" id="bidang" name="bidang" value="{{ old('bidang') }}" required>
                        @error('bidang')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="type_of_work" class="form-label">Tipe Pekerjaan</label>
                        <select class="form-select" id="type_of_work" name="type_of_work" required>
                            <option value="">Pilih Tipe</option>
                            <option value="Full-Time" {{ old('type_of_work') == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                            <option value="Part-Time" {{ old('type_of_work') == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                            <option value="Remote" {{ old('type_of_work') == 'Remote' ? 'selected' : '' }}>Remote</option>
                            <option value="Freelance" {{ old('type_of_work') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                            <option value="Internship" {{ old('type_of_work') == 'Internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('type_of_work')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gaji_min" class="form-label">Gaji Minimum (IDR)</label>
                            <input type="number" class="form-control" id="gaji_min" name="gaji_min" value="{{ old('gaji_min') }}" min="0">
                            @error('gaji_min')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gaji_max" class="form-label">Gaji Maksimum (IDR)</label>
                            <input type="number" class="form-control" id="gaji_max" name="gaji_max" value="{{ old('gaji_max') }}" min="0">
                            @error('gaji_max')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="job_description" class="form-label">Deskripsi Pekerjaan</label>
                        <textarea class="form-control" id="job_description" name="job_description" rows="5" required>{{ old('job_description') }}</textarea>
                        @error('job_description')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-modern">Posting Lowongan</button>
                </form>
            </div>
        </div>
    </main>
@endsection
