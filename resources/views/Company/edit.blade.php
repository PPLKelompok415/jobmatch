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
                        <input type="url" class="form-control" id="website_address" name="website_address" value="{{ old('website_address', $company->website_address) }}">
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
                    
                    {{-- Deskripsi umum perusahaan (jika ada di tabel companies Anda) --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Perusahaan</label>
                        <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $company->description) }}</textarea>
                        @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    {{-- Logo Perusahaan --}}
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo Perusahaan</label>
                        <input class="form-control" type="file" id="logo" name="logo">
                        @if($company->logo)
                            @php
                                $logoPath = asset('images/default_logo.png'); // Fallback default
                                $dbLogo = $company->logo;
                                if (\Illuminate\Support\Str::startsWith($dbLogo, 'company_logos/')) {
                                    $logoPath = asset('storage/' . $dbLogo);
                                } elseif (\Illuminate\Support\Str::startsWith($dbLogo, 'http://') || \Illuminate\Support\Str::startsWith($dbLogo, 'https://')) {
                                    $logoPath = $dbLogo;
                                }
                            @endphp
                            <small class="text-muted mt-2 d-block">Logo Saat Ini: <img src="{{ $logoPath }}" alt="Current Logo" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;"></small>
                        @endif
                        @error('logo')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Perbarui Data Perusahaan</button>
                        {{-- Kembali ke dashboard perusahaan --}}
                        <a href="{{ route('company.dashboard') }}" class="btn btn-secondary btn-lg">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
