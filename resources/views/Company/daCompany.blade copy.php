@extends('layouts.dashboardcompany')
@section('title', 'Dashboard Company')

@section('content')
  <div class="dashboard-container">
    <!-- Header Section -->
    <header class="dashboard-header d-flex justify-content-between align-items-center py-3 px-4">
      <h1 class="h4 mb-0">Company Dashboard</h1>
      <div class="user-profile">
        <span class="me-2">{{ Auth::user()->name }}</span>
        <i class="bi bi-person-circle fs-5"></i>
      </div>
    </header>

    <!-- Navigation Menu -->
    <nav class="dashboard-nav d-flex gap-4 px-4 py-3">
      <a href="#" class="nav-item active">
        <i class="bi bi-briefcase me-2"></i>My Jobs
      </a>
      <a href="#" class="nav-item">
        <i class="bi bi-people me-2"></i>Community
      </a>
      <a href="#" class="nav-item">
        <i class="bi bi-bell me-2"></i>Notifications
      </a>
    </nav>

    <script id="initial-jobs" type="application/json">
      {!! json_encode($myJobs) !!}
    </script>

    <!-- Main Content -->
    <main class="dashboard-content px-4 py-3">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h5 mb-0">Posted Job Positions</h2>
        <button class="btn btn-primary btn-sm">
          <i class="bi bi-plus-lg me-1"></i> Post New Job
        </button>
      </div>

      <div x-data="jobCompanyApp()" 
           x-init="initJobs(JSON.parse(document.getElementById('initial-jobs').textContent))"
           class="jobmatch-container">

        <!-- Jobs Grid -->
        <template x-if="jobs.length">
          <div class="jobs-grid">
            <template x-for="job in jobs" :key="job.id">
              <div class="job-card">
                <div class="card-header">
                  <div class="company-logo">
                    <img :src="job.company.logo || 'https://via.placeholder.com/60'" 
                         alt="Company Logo" 
                         class="img-fluid rounded-circle">
                  </div>
                  <div class="job-meta">
                    <span class="badge bg-light text-dark" x-text="job.type_of_work"></span>
                    <span class="badge bg-light text-dark" x-text="job.location"></span>
                  </div>
                </div>
                
                <div class="card-body">
                  <h5 class="job-title" x-text="job.title"></h5>
                  <p class="job-desc" x-text="job.description.substring(0, 100) + '...'"></p>
                  
                  <div class="salary-range">
                    <i class="bi bi-cash-coin"></i>
                    <span x-text="formatSalaryRange(job.gaji_min, job.gaji_max)"></span>
                  </div>
                </div>
                
                <div class="card-footer">
                  <button @click="showCompanyDetails(job.company)" 
                          class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-building me-1"></i>Company Details
                  </button>
                  <button class="btn btn-primary btn-sm">
                    <i class="bi bi-eye me-1"></i><a :href="`jobs/${job.id}/applicants`" class="btn btn-sm btn-primary">
  <i class="bi bi-eye me-1"></i>View Applicants
</a>

                  </button>
                </div>
              </div>
            </template>
          </div>
        </template>

        <!-- Empty State -->
        <template x-if="!jobs.length">
          <div class="empty-state">
            <div class="empty-icon">
              <i class="bi bi-folder2-open"></i>
            </div>
            <h3>No Jobs Posted Yet</h3>
            <p>You haven't posted any job positions. Get started by creating your first job posting.</p>
            <button class="btn btn-primary">
              <i class="bi bi-plus-lg me-1"></i> Create Job Posting
            </button>
          </div>
        </template>

        <!-- Company Details Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" x-ref="modal">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" x-text="selectedCompany.company_name"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="company-info-item">
                  <i class="bi bi-geo-alt"></i>
                  <div>
                    <h6>Address</h6>
                    <p x-text="selectedCompany.company_address"></p>
                  </div>
                </div>
                
                <div class="company-info-item">
                  <i class="bi bi-envelope"></i>
                  <div>
                    <h6>Email</h6>
                    <p x-text="selectedCompany.company_email"></p>
                  </div>
                </div>
                
                <div class="company-info-item">
                  <i class="bi bi-telephone"></i>
                  <div>
                    <h6>Phone</h6>
                    <p x-text="selectedCompany.company_phone_number"></p>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="dashboard-footer d-flex justify-content-center gap-4 py-3 px-4">
      <a href="#" class="footer-link">Terms & Conditions</a>
      <a href="#" class="footer-link">Security & Privacy</a>
      <a href="#" class="footer-link">Help Centre</a>
    </footer>
  </div>
@endsection

@push('scripts')
<script defer>
  function jobCompanyApp() {
    return {
      jobs: [],
      selectedCompany: {},
      modalInstance: null,

      initJobs(initial) {
        this.jobs = initial;
      },

      showCompanyDetails(company) {
        this.selectedCompany = company;
        if (!this.modalInstance) {
          this.modalInstance = new bootstrap.Modal(this.$refs.modal);
          this.$refs.modal.addEventListener('hidden.bs.modal', () => {
            this.selectedCompany = {};
          });
        }
        this.modalInstance.show();
      },

      formatSalaryRange(min, max) {
        if (!min && !max) return 'Salary negotiable';
        const formatter = new Intl.NumberFormat('id-ID', { 
          style: 'currency', 
          currency: 'IDR', 
          minimumFractionDigits: 0,
          maximumFractionDigits: 0
        });
        if (min && max) return `${formatter.format(min)} - ${formatter.format(max)}`;
        if (min) return `From ${formatter.format(min)}`;
        if (max) return `Up to ${formatter.format(max)}`;
        return 'Salary negotiable';
      }
    }
  }
</script>
@endpush

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
  .dashboard-container {
    background-color: #f8f9fa;
    min-height: 100vh;
  }

  .dashboard-header {
    background-color: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    border-bottom: 1px solid #eee;
  }

  .user-profile {
    display: flex;
    align-items: center;
    color: #495057;
  }

  .dashboard-nav {
    background-color: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    border-bottom: 1px solid #eee;
  }

  .nav-item {
    color: #6c757d;
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    transition: all 0.2s;
  }

  .nav-item:hover, .nav-item.active {
    color: #0d6efd;
    background-color: rgba(13, 110, 253, 0.1);
  }

  .dashboard-content {
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
  }

  .jobs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
  }

  .job-card {
    background: white;
    border-radius: 0.5rem;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.2s, box-shadow 0.2s;
    display: flex;
    flex-direction: column;
    height: 100%;
  }

  .job-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }

  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 1.25rem 1.25rem 0;
  }

  .company-logo img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border: 1px solid #eee;
  }

  .job-meta {
    display: flex;
    gap: 0.5rem;
  }

  .card-body {
    padding: 1rem 1.25rem;
    flex-grow: 1;
  }

  .job-title {
    color: #212529;
    margin-bottom: 0.75rem;
    font-size: 1.1rem;
    font-weight: 600;
  }

  .job-desc {
    color: #6c757d;
    font-size: 0.875rem;
    margin-bottom: 1rem;
  }

  .salary-range {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #28a745;
    font-weight: 500;
    font-size: 0.9rem;
  }

  .card-footer {
    padding: 1rem 1.25rem;
    background-color: #f8f9fa;
    border-top: 1px solid #eee;
    display: flex;
    justify-content: space-between;
  }

  .empty-state {
    background-color: white;
    border-radius: 0.5rem;
    padding: 3rem 2rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  }

  .empty-icon {
    font-size: 3rem;
    color: #adb5bd;
    margin-bottom: 1.5rem;
  }

  .empty-state h3 {
    color: #343a40;
    margin-bottom: 0.5rem;
  }

  .empty-state p {
    color: #6c757d;
    margin-bottom: 1.5rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
  }

  .company-info-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.25rem;
  }

  .company-info-item i {
    font-size: 1.25rem;
    color: #0d6efd;
    margin-top: 0.25rem;
  }

  .company-info-item h6 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 0.25rem;
  }

  .company-info-item p {
    color: #6c757d;
    margin-bottom: 0;
  }

  .dashboard-footer {
    background-color: white;
    border-top: 1px solid #eee;
    margin-top: 2rem;
  }

  .footer-link {
    color: #6c757d;
    text-decoration: none;
    transition: color 0.2s;
  }

  .footer-link:hover {
    color: #0d6efd;
  }

  @media (max-width: 768px) {
    .jobs-grid {
      grid-template-columns: 1fr;
    }
    
    .dashboard-nav {
      flex-direction: column;
      gap: 0.5rem;
    }
  }
</style>
@endpush