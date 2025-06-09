@extends('layouts.app') {{-- Pastikan layout ini ada dan benar --}}

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 ps-4">
            <h2 class="mb-4 fw-bold">Community</h2>

            {{-- Cek apakah ada pekerjaan yang ditemukan --}}
            {{-- Menggunakan metode isEmpty() yang ada di Eloquent Collection --}}
            @if($jobs->isEmpty())
                <p>Anda belum menaruh Lowongan Kerja</p>
            @else
                {{-- Lakukan loop untuk setiap objek pekerjaan (ini adalah objek Model Job) --}}
                @foreach($jobs as $job)
                <div class="card shadow-sm border-0 rounded-4 mb-5">
                    <div class="card-body">
                        {{-- Creative Content Writer -> title --}}
                        <h4 class="fw-bold mb-2">{{ $job->title }}</h4>
                        
                        {{-- PT Aplikasi Karya Anak Bangsa (GO-JEK Indonesia) -> company_name --}}
                        <p class="mb-1 text-muted">
                            {{ $job->company->company_name ?? 'Perusahaan Tidak Diketahui' }} 
                        </p>

                        <ul class="list-unstyled mt-3 mb-4 text-muted">
                            {{-- Jakarta Raya -> location --}}
                            <li class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i>{{ $job->location }}</li>
                            
                            {{-- Digital & Search Marketing -> bidang (sesuai data JSON jobs Anda) --}}
                            {{-- Jika Anda yakin ada kolom 'position' yang isinya seperti "Digital & Search Marketing", ganti $job->bidang menjadi $job->position --}}
                            <li class="mb-2"><i class="bi bi-journal-text me-2"></i>{{ $job->bidang }}</li> 
                            
                            {{-- Full-time -> type_of_work --}}
                            <li class="mb-2"><i class="bi bi-people-fill me-2"></i>{{ $job->type_of_work }}</li>
                            
                            {{-- 10 Juni 2025 -> created_at (diforrmat tanggal) --}}
                            <li class="mb-2"><i class="bi bi-clock me-2"></i>
                                {{ $job->created_at->format('d F Y') }}
                            </li>
                            {{-- Jika ada kolom 'deadline' di tabel jobs dan Anda ingin menampilkannya: --}}
                            {{-- <li class="mb-2"><i class="bi bi-calendar me-2"></i>Deadline: {{ $job->deadline?->format('d F Y') ?? 'N/A' }}</li> --}}
                        </ul>

                        {{-- Posted 2 days ago -> created_at (diffForHumans) --}}
                        <p class="text-secondary">Posted {{ $job->created_at->diffForHumans() }}</p>

                        <div class="d-flex gap-3 mt-3">
                            <a href="#" class="btn btn-dark px-4">Edit</a>
                            <form method="POST" action="#">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-dark px-4" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection