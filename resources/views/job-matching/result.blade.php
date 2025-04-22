@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Rekomendasi Lowongan untuk <strong>{{ $applicant->full_name }}</strong></h2>

    @if ($jobs->count())
        @foreach ($jobs as $job)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $job['job_title'] }} di {{ $job['company'] }}</h5>
                    <p class="card-text">
                        <strong>Skill cocok:</strong> {{ $job['jumlah_skill_cocok'] }}<br>
                        <strong>Selisih Gaji:</strong> Rp{{ number_format($job['selisih_gaji'], 0, ',', '.') }}
                    </p>
                </div>
            </div>
        @endforeach
    @else
        <p class="alert alert-warning">Tidak ada lowongan yang cocok untuk pelamar ini.</p>
    @endif
@endsection
