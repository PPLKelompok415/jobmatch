@extends('layouts.dashboardapplicant')

@section('title', 'Job Details')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $job->title }}</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $job->company->company_name ?? 'N/A' }}</h5>
            <p class="card-text">
                <strong>Location:</strong> {{ $job->location }}<br>
                <strong>Category:</strong> {{ $job->bidang }}<br>
                <strong>Type of Work:</strong> {{ $job->type_of_work }}<br>
                <strong>Salary:</strong> Rp {{ number_format($job->gaji_min) }} - Rp {{ number_format($job->gaji_max) }}<br>
                <strong>Posted At:</strong> {{ $job->created_at->format('d M Y') }}
            </p>
            <p class="card-text">{{ $job->description ?? 'No description available.' }}</p>

            @if($alreadyApplied)
                <button class="btn btn-secondary" disabled>Already Applied</button>
            @else
                <form action="{{ route('applicant.jobs.apply') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                    <button type="submit" class="btn btn-primary">Apply for this Job</button>
                </form>
            @endif
            <a href="{{ route('applicant.findjobs') }}" class="btn btn-secondary">Back to Jobs</a>
        </div>
    </div>
</div>
@endsection