@extends('layouts.dashboardcompany')
@section('title', 'Dashboard Company')

@section('content')
    <div class="dashboard-container">
        <header class="dashboard-header d-flex justify-content-between align-items-center py-3 px-4">
            <h1 class="h4 mb-0">Company Dashboard</h1>
            <div class="user-profile">
                <span class="me-2">{{ Auth::user()->name }}</span>
                <i class="bi bi-person-circle fs-5"></i>
            </div>
        </header>

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

        {{-- Data pekerjaan yang akan diakses oleh Alpine.js --}}
        <script id="initial-jobs" type="application/json">
            {!! json_encode($myJobs) !!}
        </script>

        <main class="dashboard-content px-4 py-3">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h5 mb-0">Posted Job Positions</h2>
                {{-- Hanya tampilkan tombol "Post New Job" jika profil perusahaan sudah lengkap (logika dari 'nyayu') --}}
                @if($companyProfileExists)
                    <a href="{{ route('company.job.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg me-1"></i> Post New Job
                    </a>
                @else
                    {{-- Tombol non-aktif jika profil belum lengkap --}}
                    <button class="btn btn-primary btn-sm" disabled title="Lengkapi profil perusahaan untuk memposting lowongan">
                        <i class="bi bi-plus-lg me-1"></i> Post New Job
                    </button>
                @endif
            </div>

            <div x-data="jobCompanyApp()" 
                 x-init="initJobs(JSON.parse(document.getElementById('initial-jobs').textContent))"
                 class="jobmatch-container">

                {{-- Pesan jika profil perusahaan belum lengkap (dari 'nyayu') --}}
                @if(!$companyProfileExists)
                    <div class="alert alert-warning text-center p-4 rounded-4 shadow-sm" role="alert">
                        <h4 class="alert-heading"><i class="bi bi-exclamation-triangle me-2"></i>Profil Perusahaan Belum Lengkap!</h4>
                        <p>Untuk dapat memposting lowongan kerja dan melihat detailnya, Anda perlu melengkapi profil perusahaan Anda terlebih dahulu.</p>
                        <hr>
                        {{-- Link ke halaman edit profil perusahaan. Pastikan rute 'companies.edit' ada dan Company ID dapat diakses. --}}
                        <a href="{{ route('companies.edit', Auth::user()->company->id ?? '') }}" class="btn btn-warning px-4">Lengkapi Profil Perusahaan</a>
                    </div>
                @else {{-- Tampilkan daftar pekerjaan jika profil perusahaan sudah lengkap (dari 'nyayu') --}}
                    <template x-if="jobs.length > 0">
                        <div class="jobs-grid">
                            <template x-for="job in jobs" :key="job.id">
                                <div class="job-card">
                                    <div class="card-header">
                                        <div class="company-logo">
                                            {{-- Menambahkan cache-busting parameter '?v=' dari 'nyayu' --}}
                                            <img :src="job.company && job.company.logo ? '{{ asset('storage') }}/' + job.company.logo + '?v=' + (job.company.updated_at_timestamp || new Date().getTime()) : 'https://placehold.co/60x60/cccccc/ffffff?text=LOGO'" 
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
                                        {{-- Menggunakan job_description sesuai model Job dari 'nyayu' --}}
                                        <p class="job-desc" x-text="job.job_description ? job.job_description.substring(0, 100) + '...' : 'Deskripsi tidak tersedia.'"></p>
                                        
                                        <div class="salary-range">
                                            <i class="bi bi-cash-coin"></i>
                                            <span x-text="formatSalaryRange(job.gaji_min, job.gaji_max)"></span>
                                        </div>

                                        <div class="job-posted-info mt-2">
                                            <i class="bi bi-calendar-check me-1"></i>
                                            <span x-text="formatDate(job.created_at)"></span>
                                        </div>
                                        <p class="text-secondary small mt-1" x-text="formatTimeAgo(job.created_at)"></p>

                                    </div>
                                    
                                    <div class="card-footer">
                                        {{-- Tombol Edit Lowongan (dari 'nyayu') --}}
                                        <a :href="`{{ route('jobs.edit', '') }}/${job.id}`" class="btn btn-info btn-sm">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>
                                        
                                        {{-- Tombol Hapus Lowongan (dari 'nyayu') --}}
                                        <form :action="`{{ route('jobs.destroy', '') }}/${job.id}`" method="POST" @submit.prevent="confirmDelete(job.id)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                        
                                        {{-- Tombol Lihat Pelamar (dari 'nyayu', dengan perbaikan URL) --}}
                                        <a :href="`{{ url('company/jobs') }}/${job.id}/applicants`" class="btn btn-primary btn-sm">
                                            <i class="bi bi-eye me-1"></i>View Applicants
                                        </a>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>

                    <template x-if="jobs.length === 0">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-folder2-open"></i>
                            </div>
                            <h3>No Jobs Posted Yet</h3>
                            <p>You haven't posted any job positions. Get started by creating your first job posting.</p>
                            <a href="{{ route('company.job.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-1"></i> Create Job Posting
                            </a>
                        </div>
                    </template>
                @endif {{-- Akhir dari kondisi companyProfileExists --}}

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

        <footer class="dashboard-footer d-flex justify-content-center gap-4 py-3 px-4">
            <a href="#" class="footer-link">Terms & Conditions</a>
            <a href="#" class="footer-link">Security & Privacy</a>
            <a href="#" class="footer-link">Help Centre</a>
        </footer>
    </div>
@endsection

@push('scripts')
<script defer>
    // Alpine.js component definition (Menggunakan Alpine.data dari 'nyayu' karena lebih disarankan)
    document.addEventListener('alpine:init', () => {
        Alpine.data('jobCompanyApp', () => ({
            jobs: [],
            selectedCompany: {},
            modalInstance: null,

            initJobs(initial) {
                // Menambahkan timestamp untuk cache-busting gambar logo (dari 'nyayu')
                this.jobs = initial.map(job => {
                    if (job.company && job.company.updated_at) {
                        job.company.updated_at_timestamp = new Date(job.company.updated_at).getTime();
                    }
                    return job;
                });
                // Inisialisasi modal hanya sekali
                if (!this.modalInstance) {
                    this.modalInstance = new bootstrap.Modal(this.$refs.modal);
                    this.$refs.modal.addEventListener('hidden.bs.modal', () => {
                        this.selectedCompany = {};
                    });
                }
            },

            showCompanyDetails(company) {
                this.selectedCompany = company;
                this.modalInstance.show();
            },

            formatSalaryRange(min, max) {
                // Menggunakan istilah Bahasa Indonesia untuk rentang gaji (dari 'nyayu')
                if (!min && !max) return 'Gaji Nego';
                const formatter = new Intl.NumberFormat('id-ID', { 
                    style: 'currency', 
                    currency: 'IDR', 
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });
                if (min && max) return `${formatter.format(min)} - ${formatter.format(max)}`;
                if (min) return `Dari ${formatter.format(min)}`;
                if (max) return `Hingga ${formatter.format(max)}`;
                return 'Gaji Nego';
            },
            
            // Fungsi format tanggal (dari 'nyayu')
            formatDate(dateString) {
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                return new Date(dateString).toLocaleDateString('id-ID', options);
            },

            // Fungsi format waktu relatif (dari 'nyayu')
            formatTimeAgo(dateString) {
                const date = new Date(dateString);
                const now = new Date();
                const seconds = Math.floor((now - date) / 1000);

                let interval = seconds / 31536000; // years
                if (interval > 1) return Math.floor(interval) + " tahun lalu";
                interval = seconds / 2592000; // months
                if (interval > 1) return Math.floor(interval) + " bulan lalu";
                interval = seconds / 86400; // days
                if (interval > 1) return Math.floor(interval) + " hari lalu";
                interval = seconds / 3600; // hours
                if (interval > 1) return Math.floor(interval) + " jam lalu";
                interval = seconds / 60; // minutes
                if (interval > 1) return Math.floor(interval) + " menit lalu";
                return Math.floor(seconds) + " detik lalu";
            },

            // Fungsi konfirmasi hapus (dari 'nyayu')
            confirmDelete(jobId) {
                if (confirm('Apakah Anda yakin ingin menghapus lowongan pekerjaan ini?')) {
                    this.$root.querySelector(`form[action$="${jobId}"]`).submit();
                }
            }
        }));
    });
</script>
@endpush

@push('styles')
{{-- Bootstrap Icons CSS (Dipertahankan dari 'main' karena diperlukan untuk ikon) --}}
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
        gap: 0.5rem; /* Tambahkan gap antar tombol dari 'nyayu' */
        flex-wrap: wrap; /* Agar tombol wrap di layar kecil dari 'nyayu' */
    }

    .card-footer .btn {
        flex-grow: 1; /* Agar tombol memenuhi ruang yang tersedia dari 'nyayu' */
        min-width: 100px; /* Lebar minimum tombol dari 'nyayu' */
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
        border-top: 1.5px solid #eee; /* Perkuat garis footer dari 'nyayu' */
        margin-top: 2rem;
        padding: 1.5rem 0; /* Beri padding lebih dari 'nyayu' */
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