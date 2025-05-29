@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-briefcase me-2"></i>
                        Manajemen Lowongan Kerja
                    </h4>
                    <div>
                        <button class="btn btn-info btn-sm" onclick="refreshData()">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">Total Lowongan</h6>
                                            <h3 class="mb-0" id="totalJobs">{{ $statistics['total'] }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-briefcase fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">Aktif</h6>
                                            <h3 class="mb-0" id="activeJobs">{{ $statistics['active'] }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-check-circle fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">Menunggu Review</h6>
                                            <h3 class="mb-0" id="pendingJobs">{{ $statistics['pending'] }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-clock fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">Expired</h6>
                                            <h3 class="mb-0" id="expiredJobs">{{ $statistics['expired'] }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-times-circle fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Search and Filter -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" placeholder="Cari judul lowongan..." 
                                       id="searchInput" value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="statusFilter">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="categoryFilter">
                                <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                                @foreach($categories as $key => $value)
                                    <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="sortBy">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Judul A-Z</option>
                                <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Judul Z-A</option>
                                <option value="deadline" {{ request('sort') == 'deadline' ? 'selected' : '' }}>Deadline</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-secondary w-100" onclick="resetFilters()">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </div>
                    
                    <!-- Job Postings Table -->
                    <div class="table-responsive" id="jobsTableContainer">
                        @include('admin.partials.jobs-table-simple', ['jobs' => $jobs])
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4" id="paginationContainer">
                        <div>
                            <span class="text-muted">
                                Menampilkan {{ $jobs->firstItem() ?? 0 }}-{{ $jobs->lastItem() ?? 0 }} 
                                dari {{ $jobs->total() }} lowongan
                            </span>
                        </div>
                        {{ $jobs->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Job -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Lowongan Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailModalBody">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Lowongan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus lowongan <strong id="deleteJobTitle"></strong>?</p>
                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan!</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Approve/Reject -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Konfirmasi Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="statusModalBody">
                <!-- Content will be filled by JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmStatus">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let jobToDelete = null;
    let jobToUpdate = null;
    let statusAction = null;
    
    // CSRF Token setup for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // Handle Detail Job
    $(document).on('click', '.detail-job', function() {
        const jobId = $(this).data('job-id');
        showJobDetail(jobId);
    });
    
    // Handle Delete Job
    $(document).on('click', '.delete-job', function() {
        jobToDelete = $(this).data('job-id');
        const jobTitle = $(this).data('job-title');
        $('#deleteJobTitle').text(jobTitle);
        $('#deleteModal').modal('show');
    });
    
    // Handle Approve Job
    $(document).on('click', '.approve-job', function() {
        jobToUpdate = $(this).data('job-id');
        statusAction = 'approve';
        $('#statusModalLabel').text('Approve Lowongan');
        $('#statusModalBody').html('<p>Apakah Anda yakin ingin menyetujui lowongan ini?</p>');
        $('#confirmStatus').removeClass('btn-danger').addClass('btn-success').text('Approve');
        $('#statusModal').modal('show');
    });
    
    // Handle Reject Job
    $(document).on('click', '.reject-job', function() {
        jobToUpdate = $(this).data('job-id');
        statusAction = 'reject';
        $('#statusModalLabel').text('Reject Lowongan');
        $('#statusModalBody').html('<p>Apakah Anda yakin ingin menolak lowongan ini?</p>');
        $('#confirmStatus').removeClass('btn-success').addClass('btn-danger').text('Reject');
        $('#statusModal').modal('show');
    });
    
    // Handle Reactivate Job
    $(document).on('click', '.reactivate-job', function() {
        jobToUpdate = $(this).data('job-id');
        statusAction = 'reactivate';
        $('#statusModalLabel').text('Reaktivasi Lowongan');
        $('#statusModalBody').html('<p>Apakah Anda yakin ingin mengaktifkan kembali lowongan ini?</p>');
        $('#confirmStatus').removeClass('btn-danger').addClass('btn-primary').text('Reaktivasi');
        $('#statusModal').modal('show');
    });
    
    // Confirm delete
    $('#confirmDelete').click(function() {
        if (jobToDelete) {
            $.ajax({
                url: `/admin/jobs/${jobToDelete}`,
                method: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        $(`#job-row-${jobToDelete}`).fadeOut(500, function() {
                            $(this).remove();
                        });
                        $('#deleteModal').modal('hide');
                        showAlert('success', response.message);
                        updateStatistics();
                    } else {
                        showAlert('error', response.message);
                    }
                },
                error: function(xhr) {
                    showAlert('error', 'Gagal menghapus lowongan');
                },
                complete: function() {
                    jobToDelete = null;
                }
            });
        }
    });
    
    // Confirm status change
    $('#confirmStatus').click(function() {
        if (jobToUpdate && statusAction) {
            $.ajax({
                url: `/admin/jobs/${jobToUpdate}/status`,
                method: 'PATCH',
                data: {
                    action: statusAction
                },
                success: function(response) {
                    if (response.success) {
                        updateJobRowStatus(jobToUpdate, response.newStatus);
                        $('#statusModal').modal('hide');
                        showAlert('success', response.message);
                        updateStatistics();
                    } else {
                        showAlert('error', response.message);
                    }
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    showAlert('error', response?.message || 'Gagal mengupdate status lowongan');
                },
                complete: function() {
                    jobToUpdate = null;
                    statusAction = null;
                }
            });
        }
    });
    
    // Search functionality with debounce
    let searchTimeout;
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            applyFilters();
        }, 500);
    });
    
    // Filter functionality
    $('#statusFilter, #categoryFilter, #sortBy').on('change', function() {
        applyFilters();
    });
    
    // Refresh data
    window.refreshData = function() {
        applyFilters();
        updateStatistics();
    };
    
    // Reset filters
    window.resetFilters = function() {
        $('#searchInput').val('');
        $('#statusFilter').val('all');
        $('#categoryFilter').val('all');
        $('#sortBy').val('newest');
        applyFilters();
    };
});

// Apply filters function with AJAX
function applyFilters() {
    const searchTerm = $('#searchInput').val();
    const statusFilter = $('#statusFilter').val();
    const categoryFilter = $('#categoryFilter').val();
    const sortBy = $('#sortBy').val();
    
    $.ajax({
        url: '/admin/jobs/filter',
        method: 'GET',
        data: {
            search: searchTerm,
            status: statusFilter,
            category: categoryFilter,
            sort: sortBy
        },
        beforeSend: function() {
            $('#jobsTableContainer').html('<div class="text-center p-4"><div class="spinner-border"></div><p>Memuat data...</p></div>');
        },
        success: function(response) {
            if (response.success) {
                $('#jobsTableContainer').html(response.html);
                $('#paginationContainer').html(response.pagination);
            } else {
                showAlert('error', response.message);
            }
        },
        error: function() {
            showAlert('error', 'Gagal memuat data');
        }
    });
}

// Show job detail function with AJAX
function showJobDetail(jobId) {
    $('#detailModal').modal('show');
    
    $('#detailModalBody').html(`
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Memuat data...</p>
        </div>
    `);
    
    $.ajax({
        url: `/admin/jobs/${jobId}`,
        method: 'GET',
        success: function(response) {
            if (response.success) {
                $('#detailModalBody').html(response.data.html);
            } else {
                $('#detailModalBody').html('<div class="alert alert-danger">Gagal memuat data lowongan</div>');
            }
        },
        error: function() {
            $('#detailModalBody').html('<div class="alert alert-danger">Terjadi kesalahan saat memuat data</div>');
        }
    });
}

// Update job row status
function updateJobRowStatus(jobId, newStatus) {
    const row = $(`#job-row-${jobId}`);
    const statusCell = row.find('.job-status');
    const actionCell = row.find('.job-actions');
    
    // Update status badge
    let statusBadge = '';
    let actionButtons = '';
    
    switch(newStatus) {
        case 'active':
            statusBadge = '<span class="badge bg-success">Aktif</span>';
            actionButtons = `
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-info detail-job" data-job-id="${jobId}" title="Detail">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-warning edit-job" data-job-id="${jobId}" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger delete-job" data-job-id="${jobId}" data-job-title="" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            break;
        case 'rejected':
            statusBadge = '<span class="badge bg-danger">Ditolak</span>';
            actionButtons = `
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-info detail-job" data-job-id="${jobId}" title="Detail">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-success approve-job" data-job-id="${jobId}" title="Approve">
                        <i class="fas fa-check"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger delete-job" data-job-id="${jobId}" data-job-title="" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            break;
        case 'pending':
            statusBadge = '<span class="badge bg-warning">Menunggu</span>';
            actionButtons = `
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-info detail-job" data-job-id="${jobId}" title="Detail">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-success approve-job" data-job-id="${jobId}" title="Approve">
                        <i class="fas fa-check"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger reject-job" data-job-id="${jobId}" title="Reject">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            break;
    }
    
    statusCell.html(statusBadge);
    actionCell.html(actionButtons);
}

// Update statistics
function updateStatistics() {
    $.ajax({
        url: '/admin/jobs/statistics',
        method: 'GET',
        success: function(response) {
            if (response.success) {
                $('#totalJobs').text(response.data.total);
                $('#activeJobs').text(response.data.active);
                $('#pendingJobs').text(response.data.pending);
                $('#expiredJobs').text(response.data.expired);
            }
        },
        error: function() {
            console.error('Failed to update statistics');
        }
    });
}

// Alert function
function showAlert(type, message) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
    
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <i class="fas ${iconClass} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    
    // Remove existing alerts
    $('.alert').remove();
    
    // Add new alert
    $('.card-body').first().prepend(alertHtml);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        $('.alert').fadeOut();
    }, 5000);
}
</script>
@endpush
@endsection