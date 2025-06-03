@extends('layouts.dashboardapplicant')

@section('content')
  <header class="topbar d-flex justify-content-between align-items-center py-2">
  </header>

  <nav class="menu my-3 d-flex gap-3">
    <div>Bookmark</div>
    <div>Community</div>
    <div>Notification & Announcement</div>
  </nav>

  <script id="initial-jobs" type="application/json">
    {!! json_encode($matchingJobs) !!}
  </script>

  <div x-data="jobMatchApp()" 
       x-init="initJobs(JSON.parse(document.getElementById('initial-jobs').textContent))"
       class="jobmatch">

    <template x-if="jobs.length">
      <div class="card-container row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <template x-for="job in jobs" :key="job.id">
          <div class="col">
            <div class="card h-100 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 0.625rem;">
              <div class="card-body d-flex gap-3 align-items-center">
                <div class="company-logo flex-shrink-0">
                  <img :src="job.company.logo" alt="Company Logo" class="img-fluid" style="max-height: 60px; object-fit: contain;">
                </div>
                <div class="job-info flex-grow-1">
                  <h5 class="card-title mb-1" x-text="job.company.company_name"></h5>
                  <p class="card-text mb-1"><strong x-text="job.title"></strong></p>
                  
                  <!-- Salary Range -->
                  <p class="salary">💰 <span x-text="formatSalaryRange(job.gaji_min, job.gaji_max)"></span></p>

                  <div class="meta small">
                    📍 <span x-text="job.location"></span> &nbsp;|&nbsp;
                    🕐 <span x-text="job.type_of_work"></span>
                  </div>
                  
                  <div class="mt-2">
                    <button 
                      @click="showCompanyDetails(job.company)" 
                      class="btn btn-light btn-sm"
                    >Details</button>
                    
                    <button 
                      @click="applyJob(job)" 
                      :disabled="job.applied" 
                      :class="job.applied ? 'btn btn-secondary btn-sm ms-2' : 'btn btn-success btn-sm ms-2'"
                      x-text="job.applied ? 'Applied' : 'Apply'"
                    ></button>
                  </div>
                </div>
                <div class="match-score fw-bold fs-5" x-text="job.match_score + '%'"></div>
              </div>
            </div>
          </div>
        </template>
      </div>
    </template>

    <template x-if="!jobs.length">
      <div class="no-match-box text-center p-5" style="background: #bcc7cf; border-radius: .625rem;">
        <i style="font-size: 2rem;">🗂️</i>
        <div><strong>No Match</strong></div>
      </div>
    </template>

    <!-- Bootstrap Modal for Company Details -->
    <div class="modal fade" tabindex="-1" role="dialog" x-ref="modal">
      <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" x-text="selectedCompany?.company_name || ''"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <template x-if="selectedCompany">
              <div>
                <p><strong>Address:</strong> <span x-text="selectedCompany.company_address || 'N/A'"></span></p>
                <p><strong>Email:</strong> <span x-text="selectedCompany.company_email || 'N/A'"></span></p>
                <p><strong>Phone:</strong> <span x-text="selectedCompany.company_phone_number || 'N/A'"></span></p>
              </div>
            </template>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  </div>

  <footer class="mt-4 d-flex justify-content-center gap-5">
    <div>Terms & Conditions</div>
    <div>Security & Privacy</div>
    <div>Help Centre</div>
  </footer>
@endsection

@push('scripts')
<script defer>
  function jobMatchApp() {
    return {
      jobs: [],
      selectedCompany: null,
      modalInstance: null,

      initJobs(initial) {
        this.jobs = initial.map(job => ({
          ...job,
          applied: job.applied ?? false
        }));
      },

      async fetchJobs() {
        try {
          const response = await fetch("{{ route('applicant.dashboard.data') }}");
          if (!response.ok) throw new Error('Failed to fetch jobs');
          
          const freshJobs = await response.json();
          this.jobs = freshJobs.map(freshJob => {
            const existing = this.jobs.find(j => j.id === freshJob.id);
            return {
              ...freshJob,
              applied: existing ? existing.applied : (freshJob.applied ?? false)
            };
          });
        } catch (error) {
          console.error('Error fetching jobs:', error);
          this.showAler
          t('Failed to refresh jobs', 'error');
        }
      },

      showCompanyDetails(company) {
        this.selectedCompany = company;

        if (!this.modalInstance) {
          this.modalInstance = new bootstrap.Modal(this.$refs.modal);
          this.$refs.modal.addEventListener('hidden.bs.modal', () => {
            this.selectedCompany = null;
          });
        }

        this.modalInstance.show();
      },

      async applyJob(job) {
        if (job.applied) return;

        try {
          const response = await fetch("{{ route('applicant.jobs.apply') }}", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ job_id: job.id }),
          });

          if (!response.ok) {
            if (response.status === 409) {
              throw new Error('You have already applied to this job');
            }
            throw new Error('Failed to apply for job');
          }

          const result = await response.json();
          job.applied = true;
          this.showAlert('Successfully applied to job!', 'success');

        } catch (error) {
          console.error('Error applying for job:', error);
          this.showAlert(error.message, 'error');
        }
      },

      showAlert(message, type = 'info') {
        const icon = type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️';
        alert(`${icon} ${message}`);
      },

      formatSalary(salary) {
        if (!salary) return 'N/A';
        return new Intl.NumberFormat('id-ID', { 
          style: 'currency', 
          currency: 'IDR', 
          minimumFractionDigits: 0 
        }).format(salary);
      },

      formatSalaryRange(min, max) {
        if (!min && !max) return 'N/A';
        
        const formatter = new Intl.NumberFormat('id-ID', { 
          style: 'currency', 
          currency: 'IDR', 
          minimumFractionDigits: 0 
        });
        
        if (min && max) return `${formatter.format(min)} - ${formatter.format(max)}`;
        if (min) return `≥ ${formatter.format(min)}`;
        if (max) return `≤ ${formatter.format(max)}`;
        return 'N/A';
      }
    }
  }
</script>
@endpush

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
  .no-match-box { 
    color: #2e3e4e; 
  }

  .job-info p.salary {
    font-weight: 600;
    font-size: 0.9rem;
    color: #ffdd57;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.3rem;
  }
  
  .job-info p.position-match,
  .job-info p.salary-match {
    font-weight: 600;
    font-size: 0.85rem;
    color: #d1d1d1;
    margin-bottom: 0.3rem;
  }

  .btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
</style>
@endpush