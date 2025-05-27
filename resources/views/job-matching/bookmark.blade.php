@extends('layouts.app')

@section('content')
<div class="mb-2 border-bottom pb-2 d-flex justify-content-start gap-4 small text-muted">
    <a class='btn active' href="{{route('bookmark.index')}}">Bookmark</a>
    <a class='btn' href="#">Community</a>
    <a class='btn' href="#">Notification & Announcement</a>
</div>

<!-- Title -->
<h3 class="fw-bold mb-3">Bookmark</h3>

<!-- Saved Label -->
<div class="d-flex align-items-center mb-4">
    <svg width="24" height="24" fill="currentColor" class="me-2 text-dark" viewBox="0 0 16 16">
        <path d="M2 2v13.5l5.5-3.5L13 15.5V2z"/>
    </svg>
    <span class="text-muted fw-semibold">Saved</span>
</div>

@if($bookmarks->isEmpty())
    <!-- Empty State -->
    <div class="text-center p-5 border rounded-3" style="border-color: #ccc;">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#9ca3af" class="mb-3" viewBox="0 0 16 16">
            <path d="M2 2v13.5l5.5-3.5L13 15.5V2z"/>
        </svg>
        <h5 class="fw-bold text-muted">No saved jobs yet</h5>
        <p class="text-muted">Save jobs you’re interested in so you can come back to them later.</p>
    </div>
@else
    @foreach($bookmarks as $bookmark)
        @php
            $job = $bookmark->job;
        @endphp
        <div class="border rounded-3 p-4 mb-4" style="border-color: #2a3b47;">
            <h5 class="fw-bold text-dark">{{ $job->title ?? '-' }}</h5>
            <p class="mb-1">
                <strong>Type of Work:</strong> {{ $job->type_of_work ?? '-' }} <br>
                <strong>Bidang:</strong> {{ $job->bidang ?? '-' }}
            </p>

            <!-- Location -->
            <div class="d-flex align-items-center text-muted mb-1">
                <svg width="18" height="18" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path d="M8 0a5.53 5.53 0 0 0-5.5 5.5c0 4.4 5.5 10.5 5.5 10.5s5.5-6.1 5.5-10.5A5.53 5.53 0 0 0 8 0zm0 8A2.5 2.5 0 1 1 8 3a2.5 2.5 0 0 1 0 5z"/>
                </svg>
                <small>{{ $job->location ?? '-' }}</small>
            </div>

            <!-- Salary Range -->
            <p class="mb-1 text-muted">
                Gaji: Rp{{ number_format($job->gaji_min ?? 0, 0, ',', '.') }} - Rp{{ number_format($job->gaji_max ?? 0, 0, ',', '.') }}
            </p>

            <!-- Post Date -->
            <small class="text-primary d-block mb-2">
                Posted 
                @if($job && $job->created_at)
                    {{ $job->created_at->diffForHumans() }}
                @else
                    some time ago
                @endif
            </small>

            <!-- Apply Button -->
            <a href="{{ route('chat') }}" class="btn btn-dark d-inline-flex align-items-center gap-2">
                Apply <span>&#8599;</span>
            </a>
        </div>
    @endforeach
@endif

<!-- Footer -->
<footer class="d-flex justify-content-end gap-4 small text-muted mt-4">
    <a class='btn' href="#">Terms & Conditions</a>
    <a class='btn' href="#">Security & Privacy</a>
    <a class='btn' href="#">Help Centre</a>
</footer>
@endsection
