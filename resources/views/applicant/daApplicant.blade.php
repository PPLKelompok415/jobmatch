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
                  <button 
                    @click="showCompanyDetails(job.company)" 
                    class="btn btn-light btn-sm mt-2"
                  >Details</button>
                  
                  <button 
                    @click="applyJob(job)" 
                    :disabled="job.applied || job.loading" 
                    :class="{
                      'btn btn-success btn-sm mt-2 ms-2': !job.applied,
                      'btn btn-secondary btn-sm mt-2 ms-2': job.applied
                    }"
                  >
                    <template x-if="job.loading">
                      <span><i class="bi bi-hourglass-split me-1"></i>Applying...</span>
                    </template>
                    <template x-if="!job.loading && !job.applied">
                      <span><i class="bi bi-check-circle me-1"></i>Apply</span>
                    </template>
                    <template x-if="!job.loading && job.applied">
                      <span><i class="bi bi-check2-all me-1"></i>Applied</span>
                    </template>
                  </button>
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
            <h5 class="modal-title" x-text="selectedCompany.company_name"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p><strong>Address:</strong> <span x-text="selectedCompany.company_address"></span></p>
            <p><strong>Email:</strong> <span x-text="selectedCompany.company_email"></span></p>
            <p><strong>Phone:</strong> <span x-text="selectedCompany.company_phone_number"></span></p>
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
      selectedCompany: {},
      modalInstance: null,

      initJobs(initial) {
        this.jobs = initial.map(job => ({
          ...job,
          applied: job.applied ?? false,
          loading: false
        }));
      },

      async fetchJobs() {
        try {
          let res = await fetch("{{ route('applicant.dashboard.data') }}");
          if (!res.ok) throw new Error('Network error');
          let freshJobs = await res.json();
          this.jobs = freshJobs.map(freshJob => {
            const existing = this.jobs.find(j => j.id === freshJob.id);
            return {
              ...freshJob,
              applied: existing ? existing.applied : (freshJob.applied ?? false),
              loading: false,
            };
          });
        } catch (e) {
          console.error(e);
          alert('Failed to refresh jobs.');
        }
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

      applyJob(job) {
        if (job.applied || job.loading) return;

        job.loading = true;

        fetch("{{ route('jobs.apply') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
          body: JSON.stringify({ job_id: job.id }),
        })
        .then(res => {
          if (!res.ok) {
            if(res.status === 409) throw new Error('You have already applied.');
            throw new Error('Failed to apply job');
          }
          return res.json();
        })
        .then(() => {
          job.applied = true;
          alert('✅ Successfully applied to job!');
        })
        .catch(err => {
          console.error(err);
          alert('❌ ' + err.message);
        })
        .finally(() => {
          job.loading = false;
        });
      },

      formatSalary(salary) {
        if (!salary) return 'N/A';
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(salary);
      },

      formatSalaryRange(min, max) {
        if (!min && !max) return 'N/A';
        const formatter = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });
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
  .no-match-box { color: #2e3e4e; }

  .job-info p.salary {
    font-weight: 600;
    font-size: 0.9rem;
    color: #ffdd57; /* kuning keemasan */
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
</style>
@endpush
