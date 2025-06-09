@extends('layouts.dashboardapplicant')

@section('content')
<div class="container">
    <h1 class="mb-4">Find Jobs</h1>

    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-md-4">
            <select class="form-select" id="categoryFilter" onchange="searchJobs()">
                <option value="all" {{ $category === 'all' ? 'selected' : '' }}>All Categories</option>
                @foreach($categories as $key => $value)
                    <option value="{{ $key }}" {{ $category === $key ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" id="searchInput" placeholder="Search jobs..." value="{{ $search }}">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary w-100" onclick="searchJobs()">Search Jobs</button>
        </div>
    </div>

    <!-- Jobs List -->
    <div id="jobsContainer">
        @foreach($jobs as $job)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $job->title }}</h5>
                    <p class="card-text">
                        <strong>Company:</strong> {{ $job->company->company_name ?? 'N/A' }}<br>
                        <strong>Location:</strong> {{ $job->location }}<br>
                        <strong>Category:</strong> {{ $job->bidang }}
                    </p>
                    <a href="{{ route('applicant.jobs.details', $job->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $jobs->links() }}
    </div>
</div>

<script>
    function searchJobs() {
        const category = document.getElementById('categoryFilter').value;
        const search = document.getElementById('searchInput').value;

        // Redirect dengan parameter query
        const url = new URL(window.location.href);
        url.searchParams.set('category', category);
        url.searchParams.set('search', search);
        window.location.href = url.toString();
    }
</script>
@endsection