@extends('layouts.app')

@section('content')
    <!-- Navigation Tabs -->
    <div class="mb-2 border-bottom pb-2 d-flex justify-content-start gap-4 small text-muted">
        <a class='btn text-primary fw-semibold border-bottom border-primary' href="#">Bookmark</a>
        <a class='btn text-muted' href="#">Community</a>
        <a class='btn text-muted' href="#">Notification & Announcement</a>
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

    <!-- Empty State Card -->
    <div class="border rounded-4 text-center p-5" style="border-color: #cfd8dc;">
        <div class="mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="text-muted" viewBox="0 0 16 16">
                <path d="M2 2v13.5l5.5-3.5L13 15.5V2z"/>
            </svg>
        </div>
        <h6 class="text-muted fw-semibold mb-2">No saved jobs yet</h6>
        <p class="text-muted">Save jobs you’re interested in so you can come back to them later.</p>
    </div>

    <!-- Footer -->
    <footer class="d-flex justify-content-end gap-4 small text-muted mt-4">
        <a class='btn' href="#">Terms & Conditions</a>
        <a class='btn' href="#">Security & Privacy</a>
        <a class='btn' href="#">Help Centre</a>
    </footer>
@endsection
