<div class="row">
    <div class="col-md-8">
        <div class="job-detail-content">
            <!-- Job Header -->
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h4 class="mb-2">{{ $job->company->position ?? 'N/A' }}</h4>
                    <div class="job-badges mb-3">
                        @php
                            $categoryBadges = [
                                'full_time' => 'bg-primary',
                                'part_time' => 'bg-info', 
                                'contract' => 'bg-warning',
                                'freelance' => 'bg-success',
                                'internship' => 'bg-secondary'
                            ];
                            $badgeClass = $categoryBadges[$job->company->type_of_work ?? 'full_time'] ?? 'bg-secondary';
                        @endphp
                        <span class="badge {{ $badgeClass }} me-2">
                            {{ ucfirst(str_replace('_', ' ', $job->company->type_of_work ?? 'Full Time')) }}
                        </span>
                        @if($job->company->location)
                            <span class="badge bg-outline-primary me-2">{{ $job->company->location }}</span>
                        @endif
                    </div>
                </div>
                <div class="text-end">
                    @php
                        $isExpired = $job->company->deadline && $job->company->deadline < now();
                        $statusClass = $isExpired ? 'bg-danger' : 'bg-success';
                        $statusText = $isExpired ? 'Expired' : 'Aktif';
                    @endphp
                    <span class="badge {{ $statusClass }} fs-6">{{ $statusText }}</span>
                </div>
            </div>
            
            <!-- Job Description -->
            @if($job->company->job_description)
            <div class="section mb-4">
                <h6 class="section-title">Deskripsi Pekerjaan:</h6>
                <div class="section-content">
                    {!! nl2br(e($job->company->job_description)) !!}
                </div>
            </div>
            @endif
            
            <!-- Company Information as Requirements -->
            <div class="section mb-4">
                <h6 class="section-title">Informasi Lowongan:</h6>
                <div class="section-content">
                    <ul class="mb-0">
                        @if($job->company->type_of_work)
                            <li>Tipe Pekerjaan: {{ ucfirst(str_replace('_', ' ', $job->company->type_of_work)) }}</li>
                        @endif
                        @if($job->company->location)
                            <li>Lokasi: {{ $job->company->location }}</li>
                        @endif
                        @if($job->company->salary_min && $job->company->salary_max)
                            <li>Range Gaji: Rp {{ number_format($job->company->salary_min / 1000000, 0) }}-{{ number_format($job->company->salary_max / 1000000, 0) }} Juta</li>
                        @endif
                        @if($job->company->deadline)
                            <li>Deadline Aplikasi: {{ \Carbon\Carbon::parse($job->company->deadline)->format('d F Y') }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Job Information Card -->
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="card-title d-flex align-items-center">
                    <i class="fas fa-info-circle me-2"></i>
                    Informasi Lowongan
                </h6>
                <table class="table table-borderless table-sm">
                    <tr>
                        <td><strong>ID Lowongan:</strong></td>
                        <td>#{{ $job->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Perusahaan:</strong></td>
                        <td>{{ $job->company->company_name ?? 'N/A' }}</td>
                    </tr>
                    @if($job->company->company_email)
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>
                            <small>{{ $job->company->company_email }}</small>
                        </td>
                    </tr>
                    @endif
                    @if($job->company->company_phone_number)
                    <tr>
                        <td><strong>Telepon:</strong></td>
                        <td>{{ $job->company->company_phone_number }}</td>
                    </tr>
                    @endif
                    @if($job->company->website_address)
                    <tr>
                        <td><strong>Website:</strong></td>
                        <td>
                            <a href="{{ $job->company->website_address }}" target="_blank" class="text-decoration-none">
                                {{ $job->company->website_address }}
                            </a>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>Alamat:</strong></td>
                        <td>{{ $job->company->company_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lokasi Kerja:</strong></td>
                        <td>{{ $job->company->location ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Gaji:</strong></td>
                        <td>
                            @if($job->company->salary_min && $job->company->salary_max)
                                Rp {{ number_format($job->company->salary_min / 1000000, 0) }}-{{ number_format($job->company->salary_max / 1000000, 0) }} Juta
                            @else
                                Negotiable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Tipe Pekerjaan:</strong></td>
                        <td>{{ ucfirst(str_replace('_', ' ', $job->company->type_of_work ?? 'Full Time')) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Post:</strong></td>
                        <td>{{ $job->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @if($job->company->deadline)
                    <tr>
                        <td><strong>Deadline:</strong></td>
                        <td>
                            {{ \Carbon\Carbon::parse($job->company->deadline)->format('d/m/Y') }}
                            @if(\Carbon\Carbon::parse($job->company->deadline)->isPast())
                                <i class="fas fa-exclamation-triangle text-danger ms-1" title="Sudah expired"></i>
                            @else
                                <br><small class="text-muted">{{ \Carbon\Carbon::parse($job->company->deadline)->diffForHumans() }}</small>
                            @endif
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @php
                                $isExpired = $job->company->deadline && $job->company->deadline < now();
                                $statusClass = $isExpired ? 'bg-danger' : 'bg-success';
                                $statusText = $isExpired ? 'Expired' : 'Aktif';
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <!-- Application Statistics Card -->
        <div class="card">
            <div class="card-body">
                <h6 class="card-title d-flex align-items-center">
                    <i class="fas fa-chart-bar me-2"></i>
                    Statistik Aplikasi
                </h6>
                <table class="table table-borderless table-sm">
                    <tr>
                        <td><strong>Total Aplikasi:</strong></td>
                        <td>
                            <span class="badge bg-info">{{ $applicationStats['total'] }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Menunggu Review:</strong></td>
                        <td>
                            <span class="badge bg-warning">{{ $applicationStats['pending'] }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Sedang Review:</strong></td>
                        <td>
                            <span class="badge bg-primary">{{ $applicationStats['reviewing'] }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Interview:</strong></td>
                        <td>
                            <span class="badge bg-info">{{ $applicationStats['interview'] }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Diterima:</strong></td>
                        <td>
                            <span class="badge bg-success">{{ $applicationStats['accepted'] }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Ditolak:</strong></td>
                        <td>
                            <span class="badge bg-danger">{{ $applicationStats['rejected'] }}</span>
                        </td>
                    </tr>
                </table>
                
                @if($applicationStats['total'] > 0)
                <div class="mt-3">
                    <div class="text-center">
                        <small class="text-muted">Data aplikasi tersedia jika tabel job_applications sudah ada</small>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="card mt-4">
            <div class="card-body">
                <h6 class="card-title d-flex align-items-center">
                    <i class="fas fa-cogs me-2"></i>
                    Quick Actions
                </h6>
                <div class="d-grid gap-2">
                    @php
                        $isExpired = $job->company->deadline && $job->company->deadline < now();
                    @endphp
                    
                    @if($isExpired)
                        <button type="button" class="btn btn-primary btn-sm reactivate-job" data-job-id="{{ $job->id }}">
                            <i class="fas fa-redo me-2"></i>Reaktivasi Lowongan
                        </button>
                    @endif
                    
                    <button type="button" class="btn btn-warning btn-sm edit-job" data-job-id="{{ $job->id }}">
                        <i class="fas fa-edit me-2"></i>Edit Lowongan
                    </button>
                    
                    <button type="button" class="btn btn-outline-danger btn-sm delete-job" 
                            data-job-id="{{ $job->id }}" data-job-title="{{ $job->company->position ?? 'Lowongan' }}">
                        <i class="fas fa-trash me-2"></i>Hapus Lowongan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.section-title {
    color: #495057;
    font-weight: 600;
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 2px solid #e9ecef;
}

.section-content {
    color: #6c757d;
    line-height: 1.6;
}

.job-badges .badge {
    font-size: 0.75em;
}

.card-title {
    color: #495057;
    font-size: 1rem;
    font-weight: 600;
}
</style>