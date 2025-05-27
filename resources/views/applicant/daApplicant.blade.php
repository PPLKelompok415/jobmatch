@extends('layouts.app')

@section('content')
  <header class="topbar d-flex justify-content-between align-items-center py-2">
    <strong>🧊 JOBMATCH</strong>
    <button @click="fetchJobs()" class="btn btn-outline-primary btn-sm">🔄 Refresh</button>
  </header>

  <nav class="menu my-3 d-flex gap-3">
    <a class='btn' href="{{route('bookmark.index')}}"><div>Bookmark</div></a>
    <a class='btn' href="#"><div>Notification & Announcement</div></a>
    <a class='btn' href="#"><div>Community</div></a>
  </nav>

  <!-- Injected JSON data -->
  <script id="initial-jobs" type="application/json">
    {!! json_encode($matchingJobs) !!}
  </script>

  <div x-data="jobMatchApp()" 
       x-init="initJobs(JSON.parse(document.getElementById('initial-jobs').textContent))"
       class="jobmatch">
    
    <template x-if="jobs.length">
      <div class="card-container d-grid gap-4" style="grid-template-columns: repeat(auto-fill, minmax(280px,1fr));">
        <template x-for="job in jobs" :key="job.id">
          <div class="card p-3 d-flex align-items-center gap-3" style="background: #0095FF; border-radius: .625rem;">
            <div class="company-logo">
              <img :src="job.company.logo" style="max-height: 60px; object-fit: contain;">
            </div>
            <div class="job-info flex-grow-1 text-start text-white">
              <h4 class="mb-1" x-text="job.company.company_name"></h4>
              <p class="mb-1"><strong x-text="job.title"></strong></p>
              <div class="meta small">
                📍 <span x-text="job.location"></span> &nbsp;
                🕒 <span x-text="new Date(job.deadline).toLocaleDateString('en-GB', { day:'2-digit', month:'short', year:'numeric' })"></span> &nbsp;
                🕐 <span x-text="job.type_of_work"></span>
              </div>
            </div>
            <div class="match-score fw-bold" x-text="job.match_score + '%'"></div>
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
  </div>

  <footer class="mt-4 d-flex justify-content-center gap-5">
    <div>Terms & Conditions</div>
    <div>Security & Privacy</div>
    <div>Help Centre</div>
  </footer>
@endsection

@push('scripts')
  <script>
    function jobMatchApp() {
      return {
        jobs: [],

        initJobs(initial) {
          console.log("Initial jobs:", initial);
          this.jobs = initial;
        },

        async fetchJobs() {
          try {
            const res = await fetch(@json(route('applicant.dashboard.data')));
            if (!res.ok) throw new Error('Network error');
            this.jobs = await res.json();
            console.log("Fetched jobs:", this.jobs);
          } catch (e) {
            console.error(e);
          }
        }
      }
    }
  </script>
@endpush

@push('styles')
  <style>
    .no-match-box { color: #2e3e4e; }
  </style>
@endpush
