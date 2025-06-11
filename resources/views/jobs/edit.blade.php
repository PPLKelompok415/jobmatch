@extends('layouts.dashboardcompany') {{-- Pastikan halaman ini memperluas layout utama Anda --}}

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h2 class="mb-4 fw-bold text-center">Edit Lowongan Pekerjaan</h2>

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

                {{-- Form untuk mengedit lowongan pekerjaan --}}
                <form action="{{ route('jobs.update', $job->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Gunakan metode PUT untuk update --}}

                    {{-- Hidden field untuk company_id (pastikan job memiliki relasi company) --}}
                    <input type="hidden" name="company_id" value="{{ $job->company_id }}">

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Lowongan</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $job->title) }}" required>
                        @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi Pekerjaan</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $job->location) }}" required>
                        @error('location')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="bidang" class="form-label">Bidang Pekerjaan</label>
                        <input type="text" class="form-control" id="bidang" name="bidang" value="{{ old('bidang', $job->bidang) }}" required>
                        @error('bidang')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="type_of_work" class="form-label">Tipe Pekerjaan</label>
                        <select class="form-select" id="type_of_work" name="type_of_work" required>
                            <option value="">Pilih Tipe Pekerjaan</option>
                            <option value="Full Time" {{ (old('type_of_work', $job->type_of_work) == 'Full Time') ? 'selected' : '' }}>Full Time</option>
                            <option value="Part Time" {{ (old('type_of_work', $job->type_of_work) == 'Part Time') ? 'selected' : '' }}>Part Time</option>
                            <option value="Remote" {{ (old('type_of_work', $job->type_of_work) == 'Remote') ? 'selected' : '' }}>Remote</option>
                            <option value="Freelance" {{ (old('type_of_work', $job->type_of_work) == 'Freelance') ? 'selected' : '' }}>Freelance</option>
                            <option value="Internship" {{ (old('type_of_work', $job->type_of_work) == 'Internship') ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('type_of_work')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gaji_min" class="form-label">Gaji Minimum</label>
                            <input type="number" class="form-control" id="gaji_min" name="gaji_min" value="{{ old('gaji_min', $job->gaji_min) }}" min="0">
                            @error('gaji_min')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gaji_max" class="form-label">Gaji Maksimum</label>
                            <input type="number" class="form-control" id="gaji_max" name="gaji_max" value="{{ old('gaji_max', $job->gaji_max) }}" min="0">
                            @error('gaji_max')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="job_description" class="form-label">Deskripsi Pekerjaan</label>
                        <textarea class="form-control" id="job_description" name="job_description" rows="5" required>{{ old('job_description', $job->job_description) }}</textarea>
                        @error('job_description')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Perbarui Lowongan</button>
                        {{-- Kembali ke dashboard perusahaan --}}
                        <a href="{{ route('company.dashboard') }}" class="btn btn-secondary btn-lg">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
