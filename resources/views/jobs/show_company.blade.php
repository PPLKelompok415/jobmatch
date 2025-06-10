@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        @php
                            $logoPath = asset('images/default_logo.png'); // Default fallback
                            if ($company->logo) {
                                $dbLogo = $company->logo;
                                if (Str::startsWith($dbLogo, 'storage/') || Str::startsWith($dbLogo, 'http://') || Str::startsWith($dbLogo, 'https://')) {
                                    $logoPath = asset($dbLogo);
                                } else {
                                    $logoPath = asset('storage/' . $dbLogo);
                                }
                            }
                        @endphp
                        <img src="{{ $logoPath }}" 
                             alt="{{ $company->company_name ?? 'Logo Perusahaan' }}" 
                             class="rounded-circle mb-3" 
                             style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #0d6efd;">
                        <h2 class="fw-bold mb-1">{{ $company->company_name ?? 'Nama Perusahaan Tidak Diketahui' }}</h2>
                        <p class="text-muted"><i class="bi bi-envelope me-2"></i>{{ $company->company_email ?? '-' }}</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <h4 class="mb-3 fw-bold text-primary">Informasi Kontak & Lokasi</h4>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-secondary"></i>Alamat: {{ $company->company_address ?? '-' }}</li>
                        <li class="mb-2"><i class="bi bi-phone-fill me-2 text-secondary"></i>Telepon: {{ $company->company_phone_number ?? '-' }}</li>
                        <li class="mb-2"><i class="bi bi-globe me-2 text-secondary"></i>Website: 
                            <a href="{{ $company->website_address ?? '#' }}" target="_blank" class="text-decoration-none text-primary">
                                {{ $company->website_address ?? '-' }}
                            </a>
                        </li>
                    </ul>

                    {{-- Bagian detail Job, jika ada --}}
                    {{-- Ini adalah asumsi bahwa Company memiliki kolom ini, jika tidak, hapus bagian ini --}}
                    <h4 class="mb-3 fw-bold text-primary">Detail Pekerjaan (Jika Perusahaan Posting Satu Pekerjaan Utama)</h4>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="bi bi-briefcase-fill me-2 text-secondary"></i>Posisi: {{ $company->position ?? '-' }}</li>
                        <li class="mb-2"><i class="bi bi-calendar-event-fill me-2 text-secondary"></i>Tipe Pekerjaan: {{ $company->type_of_work ?? '-' }}</li>
                        <li class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-secondary"></i>Lokasi Pekerjaan: {{ $company->location ?? '-' }}</li>
                        <li class="mb-2"><i class="bi bi-cash-stack me-2 text-secondary"></i>Gaji: Rp {{ number_format($company->salary_min ?? 0, 0, ',', '.') }} - Rp {{ number_format($company->salary_max ?? 0, 0, ',', '.') }}</li>
                        <li class="mb-2"><i class="bi bi-clock-fill me-2 text-secondary"></i>Deadline: {{ $company->deadline ? \Carbon\Carbon::parse($company->deadline)->format('d F Y') : '-' }}</li>
                        <li class="mb-2"><i class="bi bi-file-earmark-text-fill me-2 text-secondary"></i>Deskripsi Pekerjaan: {{ $company->job_description ?? '-' }}</li>
                    </ul>
                    {{-- Akhir bagian detail Job --}}

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary btn-lg px-4">Edit Profil Perusahaan</a>
                        <a href="{{ route('home') }}" class="btn btn-secondary btn-lg px-4">Kembali ke Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
