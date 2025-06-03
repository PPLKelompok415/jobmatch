@extends('layouts.dashboardcompany')
@section('title', 'Job Applicants')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="dashboard-title">Applicants for: {{ $job->title }}</h1>
            <a href="{{ route('company.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('company.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Job Applicants</li>
            </ol>
        </nav>
    </div>

    <div class="dashboard-content">
        <div class="card">
            <div class="card-body">
                @if($applicants->isEmpty())
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                        <h3>No Applicants Yet</h3>
                        <p class="text-muted">There are no applicants for this job posting yet.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Applicant</th>
                                    <th>Email</th>
                                    <th>Education</th>
                                    <th>Experience</th>
                                    <th>Skills</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applicants as $application)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($application->applicant->photo)
                                                <img src="{{ asset('storage/' . $application->applicant->photo) }}" 
                                                     class="rounded-circle me-3" 
                                                     width="40" 
                                                     height="40" 
                                                     alt="Applicant photo">
                                            @else
                                                <div class="avatar me-3">
                                                    {{ substr($application->applicant->full_name, 0, 1) }}
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $application->applicant->full_name }}</h6>
                                                <small class="text-muted">{{ $application->applicant->desired_position }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $application->applicant->email }}</td>
                                    <td>
                                        @if($application->applicant->institution)
                                            {{ $application->applicant->major }} at {{ $application->applicant->institution }}
                                            ({{ $application->applicant->graduation_year }})
                                        @else
                                            <span class="text-muted">Not specified</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($application->applicant->work_company)
                                            {{ $application->applicant->work_position }} at {{ $application->applicant->work_company }}
                                        @else
                                            <span class="text-muted">No experience</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($application->applicant->hard_skills || $application->applicant->soft_skills)
                                            <div class="skill-tags">
                                                @if($application->applicant->hard_skills)
                                                    <span class="badge bg-primary me-1 mb-1">{{ $application->applicant->hard_skills }}</span>
                                                @endif
                                                @if($application->applicant->soft_skills)
                                                    <span class="badge bg-secondary">{{ $application->applicant->soft_skills }}</span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-muted">Not specified</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($application->status == 'accepted') bg-success 
                                            @elseif($application->status == 'rejected') bg-danger 
                                            @else bg-warning text-dark @endif">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            @if($application->applicant->cv_file)
                                                <a href="{{ asset('storage/' . $application->applicant->cv_file) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   target="_blank"
                                                   title="Download CV">
                                                    <i class="fas fa-file-download"></i>
                                                </a>
                                            @endif
                                            @if($application->applicant->portfolio_file)
                                                <a href="{{ asset('storage/' . $application->applicant->portfolio_file) }}" 
                                                   class="btn btn-sm btn-outline-secondary" 
                                                   target="_blank"
                                                   title="View Portfolio">
                                                    <i class="fas fa-book-open"></i>
                                                </a>
                                            @endif
                                            <form action="{{ route('company.applications.update', $application->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                    <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>Accept</option>
                                                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Reject</option>
                                                </select>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #3498db;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    
    .table th {
        font-weight: 600;
        color: #495057;
    }
    
    .empty-state {
        padding: 2rem;
    }
    
    .empty-state i {
        opacity: 0.5;
    }
    
    .skill-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.25rem;
    }
</style>
@endpush