@extends('layouts.dashboardapplicant')

@section('content')
<style>
    
</style>

<div class="container-fluid px-4">
    <br>
    <!-- Page Header -->
    <div class="d-flex align-items-center mb-4">
        <div class="dashboard-brand-icon me-3">
            <i class="bi bi-bookmark-star"></i>
        </div>
        <div>
            <h2 class="fw-bold mb-1 text-primary-custom">My Bookmarks</h2>
            <p class="text-muted mb-0">Your saved job opportunities</p>
        </div>
    </div>

    <!-- Saved Label with Modern Styling -->
    <div class="d-flex align-items-center mb-4 p-3 rounded-3" style="background: rgba(59, 130, 246, 0.05); border: 1px solid rgba(59, 130, 246, 0.1);">
        <div class="d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background: rgba(59, 130, 246, 0.1); border-radius: 10px;">
            <i class="bi bi-bookmark-check text-primary-custom fs-5"></i>
        </div>
        <div>
            <span class="fw-semibold text-primary-custom">Saved Jobs</span>
            <small class="text-muted d-block">{{ $bookmarks->count() }} job(s) bookmarked</small>
        </div>
    </div>

    @if($bookmarks->isEmpty())
        <!-- Modern Empty State -->
        <div class="text-center py-5">
            <div class="mb-4">
                <div class="mx-auto d-flex align-items-center justify-content-center" style="width: 120px; height: 120px; background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%); border-radius: 50%;">
                    <i class="bi bi-bookmark text-primary-custom" style="font-size: 3rem;"></i>
                </div>
            </div>
            <h4 class="fw-bold text-dark mb-3">No saved jobs yet</h4>
            <p class="text-muted mb-4 col-md-6 mx-auto">
                Start exploring amazing job opportunities and save the ones you're interested in. 
                Your bookmarked jobs will appear here for easy access.
            </p>
            <a href="{{ route('applicant.dashboard')}}" class="btn btn-navbar-solid">
                <i class="bi bi-search me-2"></i>
                Browse Jobs
            </a>
        </div>
    @else
        <!-- Jobs Grid -->
        <div class="row g-4">
            @foreach($bookmarks as $bookmark)
                @php
                    // Get job data from bookmark relationship
                    $job = $bookmark->job;
                    
                    // Skip if no job data
                    if (!$job) {
                        continue;
                    }
                    
                    // Get company data from job relationship
                    $company = $job->company ?? null;
                    
                    // Map the correct field names
                    $jobTitle = $job->position ?? $job->title ?? 'Job Title Not Available';
                    $jobType = $job->type_of_work ?? 'Not specified';
                    $jobLocation = $job->location ?? 'Location not specified';
                    $companyName = $company ? $company->company_name : 'Company not specified';
                    $salaryMin = $job->salary_min ?? 0;
                    $salaryMax = $job->salary_max ?? 0;
                    $createdAt = $job->created_at ?? null;
                @endphp
                <div class="col-4 mb-4">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold text-dark mb-2">{{ $jobTitle }}</h5>
                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                        @if($jobType)
                                            <span class="badge bg-light text-primary-custom border" style="border-color: var(--primary-color) !important;">
                                                <i class="bi bi-briefcase me-1"></i>
                                                {{ $jobType }}
                                            </span>
                                        @endif
                                        @if($job->bidang ?? false)
                                            <span class="badge bg-light text-dark border">
                                                <i class="bi bi-tag me-1"></i>
                                                {{ $job->bidang }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <button class="btn btn-link text-danger p-2" onclick="removeBookmark({{ $bookmark->id }})" title="Remove bookmark">
                                    <i class="bi bi-bookmark-x fs-5"></i>
                                </button>
                            </div>

                            <!-- Job Details -->
                            <div class="mb-3">
                                <!-- Company -->
                                @if($companyName && $companyName !== 'Company not specified')
                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <i class="bi bi-building me-2 text-primary-custom"></i>
                                        <span class="fw-semibold">{{ $companyName }}</span>
                                    </div>
                                @endif

                                <!-- Location -->
                                @if($jobLocation && $jobLocation !== 'Location not specified')
                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <i class="bi bi-geo-alt me-2 text-primary-custom"></i>
                                        <span>{{ $jobLocation }}</span>
                                    </div>
                                @endif

                                <!-- Salary Range -->
                                @if($salaryMin > 0 || $salaryMax > 0)
                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <i class="bi bi-currency-dollar me-2 text-success"></i>
                                        <span>
                                            @if($salaryMin > 0 && $salaryMax > 0)
                                                Rp{{ number_format($salaryMin, 0, ',', '.') }} - Rp{{ number_format($salaryMax, 0, ',', '.') }}
                                            @elseif($salaryMin > 0)
                                                From Rp{{ number_format($salaryMin, 0, ',', '.') }}
                                            @else
                                                Up to Rp{{ number_format($salaryMax, 0, ',', '.') }}
                                            @endif
                                        </span>
                                    </div>
                                @endif

                                <!-- Deadline -->
                                @if($job->deadline ?? false)
                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <i class="bi bi-calendar-event me-2 text-warning"></i>
                                        <span>Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('d M Y') }}</span>
                                    </div>
                                @endif

                                <!-- Post Date -->
                                <div class="d-flex align-items-center text-muted">
                                    <i class="bi bi-clock me-2 text-warning"></i>
                                    <small>
                                        Posted 
                                        @if($createdAt)
                                            {{ $createdAt->diffForHumans() }}
                                        @else
                                            some time ago
                                        @endif
                                    </small>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2 align-items-center">
                                @if($bookmark->has_chat)
                                    <a href="{{ url('/chat/' . $bookmark->company_user_id) }}" class="btn btn-navbar-solid flex-grow-1 text-white">
                                        <i class="bi bi-chat-dots me-2"></i>
                                        Go to Chat
                                    </a>
                                @else
                                    <a href="{{ url('/chat/' . $bookmark->company_user_id) }}" class="btn btn-navbar-solid flex-grow-1 text-white">
                                        <i class="bi bi-send me-2"></i>
                                        Apply Now
                                    </a>
                                @endif
                                <a href="#" class="btn btn-navbar-outline">
                                    <i class="bi bi-eye"></i>
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    /* Additional styles for bookmark page */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
    }
    
    /* Remove bookmark button hover effect */
    .btn-link:hover {
        background: rgba(239, 68, 68, 0.1);
        border-radius: 8px;
    }
    
    /* Custom scrollbar for this page */
    .container-fluid {
        max-height: calc(100vh - var(--navbar-height));
        overflow-y: auto;
    }
</style>
@endpush

@push('scripts')
<script>
    // Remove bookmark functionality
    function removeBookmark(bookmarkId) {
        if (confirm('Are you sure you want to remove this bookmark?')) {
            // Add AJAX call to remove bookmark
            fetch(`/bookmarks/${bookmarkId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to remove bookmark. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        }
    }
    
    // Add smooth animations
    document.addEventListener('DOMContentLoaded', function() {
        // Animate cards on load
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endpush