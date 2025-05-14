@extends('layouts.app')

@section('content')
@forelse($bookmarkedJobs as $job)
    <div class="border rounded-3 p-4 mb-3" style="border-color: #2a3b47;">
        <h5 class="fw-bold text-dark">{{ $job->title }}</h5>
        <p class="mb-1">{{ $job->company->name }}</p>

        <div class="d-flex align-items-center text-muted mb-1">
            <svg width="18" height="18" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                <path d="M8 0a5.53 5.53 0 0 0-5.5 5.5c0 4.4 5.5 10.5 5.5 10.5s5.5-6.1 5.5-10.5A5.53 5.53 0 0 0 8 0zm0 8A2.5 2.5 0 1 1 8 3a2.5 2.5 0 0 1 0 5z"/>
            </svg>
            <small>{{ $job->location }}</small>
        </div>

        <small class="text-primary d-block mb-2">Saved</small>

        <a href="{{ route('chat') }}" class="btn btn-dark d-inline-flex align-items-center gap-2">
            Apply <span>&#8599;</span>
        </a>
    </div>
@empty
    <div class="text-center">
        <p class="text-muted">No saved jobs yet</p>
        <p class="text-muted">Save jobs you’re interested in so you can come back to them later.</p>
    </div>
@endforelse
