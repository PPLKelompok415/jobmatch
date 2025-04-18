@extends('layouts.app')

@section('content')
    <div class="mb-2 border-bottom pb-2 d-flex justify-content-start gap-4 small text-muted">
        <a class='btn active' href="#">Bookmark</a>
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

    <!-- Job Card -->
    <div class="border rounded-3 p-4" style="border-color: #2a3b47;">
        <h5 class="fw-bold text-dark">Creative Content Writer</h5>
        <p class="mb-1">PT Aplikasi Karya Anak Bangsa (GO-JEK Indonesia)</p>

        <!-- Location -->
        <div class="d-flex align-items-center text-muted mb-1">
            <svg width="18" height="18" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                <path d="M8 0a5.53 5.53 0 0 0-5.5 5.5c0 4.4 5.5 10.5 5.5 10.5s5.5-6.1 5.5-10.5A5.53 5.53 0 0 0 8 0zm0 8A2.5 2.5 0 1 1 8 3a2.5 2.5 0 0 1 0 5z"/>
            </svg>
            <small>Jakarta Raya</small>
        </div>

        <!-- Post Date -->
        <small class="text-primary d-block mb-2">Posted 2 days ago</small>

        <!-- Description -->
        <p class="text-muted mb-3" style="max-width: 600px;">
            If you’re looking to be part of a dynamic, highly creative, and data-driven team while honing your storytelling skills across various formats and p...
        </p>

        <!-- Apply Button -->
        <a href="{{route('chat')}}" class="btn btn-dark d-inline-flex align-items-center gap-2">
            Apply <span>&#8599;</span>
        </a>
    </div>

    <!-- Footer -->
    <footer class="d-flex justify-content-end gap-4 small text-muted mt-4">
        <a class='btn' href="#">Terms & Conditions</a>
        <a class='btn' href="#">Security & Privacy</a>
        <a class='btn' href="#">Help Centre</a>
    </footer>
@endsection
