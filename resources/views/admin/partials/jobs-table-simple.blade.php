<table class="table table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Judul Lowongan</th>
            <th>Perusahaan</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Gaji</th>
            <th>Tanggal Post</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($jobs as $job)
        <tr id="job-row-{{ $job->id }}">
            <td>{{ $job->id }}</td>
            <td>
                <div>
                    <strong>{{ $job->company->position ?? 'N/A' }}</strong>
                    <br>
                    <small class="text-muted">{{ ucfirst(str_replace('_', ' ', $job->company->type_of_work ?? 'Full Time')) }}</small>
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                        <span class="text-white fw-bold">
                            {{ strtoupper(substr($job->company->company_name ?? 'N', 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <span>{{ $job->company->company_name ?? 'N/A' }}</span>
                        <br>
                        <small class="text-muted">{{ $job->company->company_email ?? '' }}</small>
                    </div>
                </div>
            </td>
            <td>
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
                <span class="badge {{ $badgeClass }}">
                    {{ ucfirst(str_replace('_', ' ', $job->company->type_of_work ?? 'Full Time')) }}
                </span>
            </td>
            <td>{{ $job->company->location ?? 'N/A' }}</td>
            <td>
                @if($job->company->salary_min && $job->company->salary_max)
                    Rp {{ number_format($job->company->salary_min / 1000000, 0) }}-{{ number_format($job->company->salary_max / 1000000, 0) }} Juta
                @else
                    Negotiable
                @endif
            </td>
            <td>
                <span title="{{ $job->created_at->format('d/m/Y H:i') }}">
                    {{ $job->created_at->format('d/m/Y') }}
                </span>
                <br>
                <small class="text-muted">{{ $job->created_at->diffForHumans() }}</small>
            </td>
            <td>
                @php
                    $isExpired = $job->company->deadline && $job->company->deadline < now();
                    $statusClass = $isExpired ? 'bg-danger' : 'bg-success';
                    $statusText = $isExpired ? 'Expired' : 'Aktif';
                @endphp
                <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                @if($job->company->deadline)
                    <br>
                    <small class="text-muted">
                        Deadline: {{ \Carbon\Carbon::parse($job->company->deadline)->format('d/m/Y') }}
                    </small>
                @endif
            </td>
            <td>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-info detail-job" 
                            data-job-id="{{ $job->id }}" title="Detail">
                        <i class="fas fa-eye"></i>
                    </button>
                    
                    @php
                        $isExpired = $job->company->deadline && $job->company->deadline < now();
                    @endphp
                    
                    @if($isExpired)
                        <button type="button" class="btn btn-sm btn-secondary reactivate-job" 
                                data-job-id="{{ $job->id }}" title="Reactivate">
                            <i class="fas fa-redo"></i>
                        </button>
                    @else
                        <button type="button" class="btn btn-sm btn-warning edit-job" 
                                data-job-id="{{ $job->id }}" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                    @endif
                    
                    <button type="button" class="btn btn-sm btn-danger delete-job" 
                            data-job-id="{{ $job->id }}" 
                            data-job-title="{{ $job->company->position ?? 'Lowongan' }}" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" class="text-center py-4">
                <div class="text-muted">
                    <i class="fas fa-briefcase fa-3x mb-3"></i>
                    <h5>Tidak ada lowongan kerja</h5>
                    <p>Belum ada lowongan kerja yang terdaftar di sistem.</p>
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@if($jobs->hasPages())
<div class="d-flex justify-content-between align-items-center mt-3">
    <div>
        <span class="text-muted">
            Menampilkan {{ $jobs->firstItem() ?? 0 }}-{{ $jobs->lastItem() ?? 0 }} 
            dari {{ $jobs->total() }} lowongan
        </span>
    </div>
    {{ $jobs->appends(request()->query())->links() }}
</div>
@endif

<style>
.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 0.8rem;
}
</style>