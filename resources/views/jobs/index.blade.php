@extends('layouts.app') {{-- Pastikan halaman ini memperluas layout utama Anda --}}

{{--
    Perhatian: Bagian @section('navbar_brand_content') telah dihapus dari sini.
    Logo dan teks "JOBMATCH" kini selalu ditampilkan di navbar kiri
    oleh layouts/app.blade.php secara langsung, sesuai permintaan Anda.
--}}

{{-- Section to inject dynamic content into the right navbar logo area --}}
{{-- Akan menampilkan logo perusahaan JIKA $currentCompany ada. --}}
{{-- Jika $currentCompany TIDAK ada, Laravel akan menggunakan FALLBACK di layouts/app.blade.php --}}
{{-- yang akan menampilkan FOTO PROFIL PENGGUNA yang terautentikasi. --}}
@section('right_navbar_logo')
    @if(isset($currentCompany) && $currentCompany)
        @php
            $companyRightNavbarLogoPath = asset('images/default_logo.png'); // Default fallback
            if ($currentCompany->logo) {
                $dbLogo = $currentCompany->logo;
                if (Str::startsWith($dbLogo, 'storage/') || Str::startsWith($dbLogo, 'http://') || Str::startsWith($dbLogo, 'https://')) {
                    $companyRightNavbarLogoPath = asset($dbLogo);
                } else {
                    $companyRightNavbarLogoPath = asset('storage/' . $dbLogo);
                }
            }
        @endphp
        {{-- Menampilkan logo perusahaan di kanan jika perusahaan spesifik dipilih. --}}
        <img src="{{ $companyRightNavbarLogoPath }}?v={{ $currentCompany->updated_at ? $currentCompany->updated_at->timestamp : now()->timestamp }}" alt="{{ $currentCompany->company_name ?? 'Company Logo' }} Logo" class="profile-pic-small">
    @else
        {{-- Jika tidak ada perusahaan spesifik, section ini dibiarkan kosong. --}}
        {{-- Ini akan memicu fallback di layouts/app.blade.php untuk menampilkan foto profil user. --}}
    @endif
@endsection


@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            {{-- Dynamic page title --}}
            <h2 class="mb-4 fw-bold">
                @if(isset($currentCompany) && $currentCompany)
                    Lowongan Pekerjaan di {{ $currentCompany->company_name }}
                @else
                    Daftar Semua Lowongan Pekerjaan
                @endif
            </h2>

            {{-- "Create New Job" button if this is a company-specific page --}}
            @if(isset($currentCompany) && $currentCompany)
                <div class="mb-4">
                    <a href="{{ route('jobs.create', ['company_id' => $currentCompany->id]) }}" class="btn btn-success px-4">
                        Buat Lowongan Baru
                    </a>
                </div>
            @endif

            {{-- Display success message from redirect --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($jobs->isEmpty())
                <p>Belum ada lowongan pekerjaan saat ini.</p>
            @else
                @foreach($jobs as $job)
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            {{-- COMPANY LOGO (from job->company relation) --}}
                            @php
                                $logoPath = asset('images/default_logo.png'); // Default fallback
                                if ($job->company && $job->company->logo) {
                                    $dbLogo = $job->company->logo;
                                    // Check if path already contains 'storage/' or 'http'
                                    if (Str::startsWith($dbLogo, 'storage/') || Str::startsWith($dbLogo, 'http://') || Str::startsWith($dbLogo, 'https://')) {
                                        $logoPath = asset($dbLogo); // Use directly if 'complete'
                                    } else {
                                        $logoPath = asset('storage/' . $dbLogo); // Add 'storage/' if only relative path
                                    }
                                }
                            @endphp
                            <img src="{{ $logoPath }}?v={{ $job->company->updated_at ? $job->company->updated_at->timestamp : now()->timestamp }}" 
                                 alt="{{ $job->company->company_name ?? 'Company Logo' }} Logo" 
                                 class="rounded-circle me-3" 
                                 style="width: 70px; height: 70px; object-fit: cover;">
                            
                            <div>
                                <h4 class="fw-bold mb-0">{{ $job->title }}</h4>
                                <p class="mb-1 text-muted">
                                    {{ $job->company->company_name ?? 'Unknown Company' }} 
                                </p>
                            </div>
                        </div>
                        
                        <ul class="list-unstyled mt-3 mb-4 text-muted">
                            <li class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i>{{ $job->location }}</li>
                            <li class="mb-2"><i class="bi bi-briefcase-fill me-2"></i>Field: {{ $job->bidang ?? '-' }}</li>
                            <li class="mb-2"><i class="bi bi-people-fill me-2"></i>Type of Work: {{ $job->type_of_work }}</li>
                            @if($job->gaji_min && $job->gaji_max)
                                <li class="mb-2"><i class="bi bi-currency-dollar me-2"></i>Salary: Rp {{ number_format($job->gaji_min, 0, ',', '.') }} - Rp {{ number_format($job->gaji_max, 0, ',', '.') }}</li>
                            @else
                                <li class="mb-2"><i class="bi bi-currency-dollar me-2"></i>Salary: -</li>
                            @endif
                            <li class="mb-2"><i class="bi bi-calendar-check-fill me-2"></i>
                                Posted: {{ \Carbon\Carbon::parse($job->created_at)->format('d F Y') }}
                            </li>
                        </ul>

                        <p class="text-secondary small">Posted {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</p>

                        <div class="d-flex gap-3 mt-3">
                            {{-- EDIT JOB BUTTON --}}
                            <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-dark px-4">Edit Job</a>

                            {{-- DELETE JOB BUTTON --}}
                            <form method="POST" action="{{ route('jobs.destroy', $job->id) }}" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger px-4" type="submit">Delete Job</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- Add pagination if you are using it in the controller --}}
                {{-- {{ $jobs->links() }} --}}
            @endif
        </div>
    </div>
</div>

@endsection
