@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-user-tie me-2"></i>
                        Manajemen Pelamar
                    </h4>
                    <div>
                        <button class="btn btn-light btn-sm" onclick="refreshData()">
                            <i class="fas fa-sync-alt me-1"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Alert Container -->
                    <div id="alertContainer"></div>
                    
                    <!-- Statistics Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="card bg-success text-white shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-1">Total Pelamar</h6>
                                            <h3 class="mb-0 fw-bold">{{ $applicants->total() }}</h3>
                                        </div>
                                        <div>
                                            <i class="fas fa-users fa-2x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-primary text-white shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-1">Terdaftar Hari Ini</h6>
                                            <h3 class="mb-0 fw-bold">{{ $applicants->where('created_at', '>=', today())->count() }}</h3>
                                        </div>
                                        <div>
                                            <i class="fas fa-calendar-day fa-2x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning text-white shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-1">Bulan Ini</h6>
                                            <h3 class="mb-0 fw-bold">{{ $applicants->where('created_at', '>=', now()->startOfMonth())->count() }}</h3>
                                        </div>
                                        <div>
                                            <i class="fas fa-calendar-alt fa-2x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Search and Filter -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Cari nama atau email..." id="searchInput">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="sortBy">
                                <option value="newest">Terbaru</option>
                                <option value="oldest">Terlama</option>
                                <option value="name_asc">Nama A-Z</option>
                                <option value="name_desc">Nama Z-A</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterBy">
                                <option value="all">Semua Status</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Applicants Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 60px;">ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Pendidikan</th>
                                    <th scope="col">Tanggal Daftar</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center" style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="applicantsTable">
                                @forelse($applicants as $applicant)
                                <tr id="applicant-row-{{ $applicant->id }}">
                                    <td class="text-center">
                                        <span class="badge bg-secondary">{{ $applicant->id }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <span class="text-white fw-bold">{{ strtoupper(substr($applicant->name, 0, 1)) }}</span>
                                            </div>
                                            <div>
                                                <strong class="d-block">{{ $applicant->name }}</strong>
                                                <small class="text-muted">ID: {{ $applicant->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $applicant->email }}" class="text-decoration-none">
                                            {{ $applicant->email }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($applicant->applicant->phone ?? null)
                                            <a href="tel:{{ $applicant->applicant->phone }}" class="text-decoration-none">
                                                {{ $applicant->applicant->phone }}
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($applicant->applicant->education ?? null)
                                            <span class="badge bg-info text-dark">{{ $applicant->applicant->education }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $applicant->created_at->format('d/m/Y') }}<br>
                                            {{ $applicant->created_at->format('H:i') }}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success">Aktif</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Action buttons">
                                            <button type="button" class="btn btn-sm btn-outline-info detail-user" 
                                                    data-user-id="{{ $applicant->id }}" 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-user" 
                                                    data-user-id="{{ $applicant->id }}" 
                                                    data-user-name="{{ $applicant->name }}" 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Tidak ada data pelamar</h5>
                                            <p class="text-muted">Belum ada pelamar yang terdaftar</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($applicants->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Pagination Navigation">
                            {{ $applicants->links() }}
                        </nav>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail User -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-user me-2"></i>Detail Pelamar
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailModalBody">
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted">Memuat data...</p>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus Pelamar
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-user-times fa-3x text-danger mb-3"></i>
                </div>
                <p class="text-center">Apakah Anda yakin ingin menghapus pelamar <strong id="deleteUserName" class="text-danger"></strong>?</p>
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-danger" id="confirmDelete">
                    <i class="fas fa-trash me-1"></i>Hapus
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Handle Detail User
    $(document).on('click', '.detail-user', function() {
        const userId = $(this).data('user-id');
        showUserDetail(userId);
    });
    
    // Handle Delete User
    let userToDelete = null;
    
    $(document).on('click', '.delete-user', function() {
        userToDelete = $(this).data('user-id');
        const userName = $(this).data('user-name');
        $('#deleteUserName').text(userName);
        $('#deleteModal').modal('show');
    });
    
    // Confirm delete
    $('#confirmDelete').click(function() {
        if (userToDelete) {
            const $btn = $(this);
            const originalText = $btn.html();
            
            $.ajax({
                url: `/admin/users/${userToDelete}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Menghapus...');
                },
                success: function(response) {
                    if (response.success) {
                        $(`#applicant-row-${userToDelete}`).fadeOut(500, function() {
                            $(this).remove();
                        });
                        $('#deleteModal').modal('hide');
                        showAlert('success', response.message);
                        
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showAlert('error', response.message);
                    }
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON?.message || 'Terjadi kesalahan saat menghapus pelamar';
                    showAlert('error', errorMessage);
                },
                complete: function() {
                    $btn.prop('disabled', false).html(originalText);
                    userToDelete = null;
                }
            });
        }
    });
    
    // Search functionality with debounce
    let searchTimeout;
    $('#searchInput').on('keyup', function() {
        const searchTerm = $(this).val().toLowerCase();
        
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            filterAndSortTable();
        }, 300);
    });
    
    // Sort functionality
    $('#sortBy').on('change', function() {
        filterAndSortTable();
    });
    
    // Filter functionality
    $('#filterBy').on('change', function() {
        filterAndSortTable();
    });
    
    // Combined filter and sort function
    function filterAndSortTable() {
        const searchTerm = $('#searchInput').val().toLowerCase();
        const sortBy = $('#sortBy').val();
        const filterBy = $('#filterBy').val();
        
        let rows = Array.from($('#applicantsTable tr')).filter(row => {
            return $(row).find('td').length > 1; // Skip empty state row
        });
        
        // Filter rows based on search and status
        let filteredRows = rows.filter(row => {
            const $row = $(row);
            const name = $row.find('td:nth-child(2)').text().toLowerCase();
            const email = $row.find('td:nth-child(3)').text().toLowerCase();
            const status = $row.find('td:nth-child(7) .badge').text().toLowerCase();
            
            // Search filter
            const matchesSearch = searchTerm === '' || name.includes(searchTerm) || email.includes(searchTerm);
            
            // Status filter
            let matchesStatus = true;
            if (filterBy === 'active') {
                matchesStatus = status.includes('aktif');
            } else if (filterBy === 'inactive') {
                matchesStatus = status.includes('tidak aktif') || status.includes('nonaktif');
            }
            
            return matchesSearch && matchesStatus;
        });
        
        // Sort filtered rows
        filteredRows.sort((a, b) => {
            const $rowA = $(a);
            const $rowB = $(b);
            
            switch (sortBy) {
                case 'oldest':
                    const dateA = new Date($rowA.find('td:nth-child(6)').text().replace(/\n/g, ' '));
                    const dateB = new Date($rowB.find('td:nth-child(6)').text().replace(/\n/g, ' '));
                    return dateA - dateB;
                    
                case 'name_asc':
                    const nameA = $rowA.find('td:nth-child(2) strong').text().toLowerCase();
                    const nameB = $rowB.find('td:nth-child(2) strong').text().toLowerCase();
                    return nameA.localeCompare(nameB);
                    
                case 'name_desc':
                    const nameA2 = $rowA.find('td:nth-child(2) strong').text().toLowerCase();
                    const nameB2 = $rowB.find('td:nth-child(2) strong').text().toLowerCase();
                    return nameB2.localeCompare(nameA2);
                    
                case 'newest':
                default:
                    const dateA2 = new Date($rowA.find('td:nth-child(6)').text().replace(/\n/g, ' '));
                    const dateB2 = new Date($rowB.find('td:nth-child(6)').text().replace(/\n/g, ' '));
                    return dateB2 - dateA2;
            }
        });
        
        // Hide all rows first
        $('#applicantsTable tr').hide();
        
        // Show filtered and sorted rows
        if (filteredRows.length > 0) {
            filteredRows.forEach(row => {
                $(row).show();
            });
        } else {
            // Show "no data" message if no results
            if ($('#applicantsTable .no-results').length === 0) {
                $('#applicantsTable').append(`
                    <tr class="no-results">
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-search fa-2x text-muted mb-2"></i>
                            <p class="text-muted">Tidak ada data yang sesuai dengan filter</p>
                        </td>
                    </tr>
                `);
            }
            $('#applicantsTable .no-results').show();
        }
        
        // Remove "no results" message if there are results
        if (filteredRows.length > 0) {
            $('#applicantsTable .no-results').remove();
        }
    }
    
    // Refresh data with loading state
    window.refreshData = function() {
        const $btn = $('button[onclick="refreshData()"]');
        const originalText = $btn.html();
        
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Loading...');
        
        setTimeout(() => {
            location.reload();
        }, 500);
    };
});

// Show user detail function
function showUserDetail(userId) {
    $('#detailModal').modal('show');
    
    $('#detailModalBody').html(`
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Memuat data...</p>
        </div>
    `);
    
    $.ajax({
        url: `/admin/users/${userId}/detail`,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                const user = response.data;
                let additionalData = '';
                
                if (user.role === 'applicant' && user.applicant_data) {
                    const data = user.applicant_data;
                    additionalData = `
                        <div class="mt-4">
                            <h6 class="border-bottom pb-2 mb-3">
                                <i class="fas fa-info-circle me-2"></i>Data Pelamar
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-2">
                                                <i class="fas fa-phone me-1"></i>Kontak
                                            </h6>
                                            <p class="mb-1">${data.phone || 'Tidak tersedia'}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-2">
                                                <i class="fas fa-graduation-cap me-1"></i>Pendidikan
                                            </h6>
                                            <p class="mb-1">${data.education || 'Tidak tersedia'}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card bg-light">
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-2">
                                                <i class="fas fa-map-marker-alt me-1"></i>Alamat
                                            </h6>
                                            <p class="mb-1">${data.address || 'Tidak tersedia'}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-2">
                                                <i class="fas fa-briefcase me-1"></i>Pengalaman
                                            </h6>
                                            <p class="mb-1">${data.experience || 'Tidak tersedia'}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-2">
                                                <i class="fas fa-tools me-1"></i>Keahlian
                                            </h6>
                                            <p class="mb-1">${data.skills || 'Tidak tersedia'}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }
                
                const detailHtml = `
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <h6 class="card-title border-bottom pb-2 mb-3">
                                        <i class="fas fa-user me-2"></i>Informasi Dasar
                                    </h6>
                                    <div class="row g-2">
                                        <div class="col-4"><strong>ID:</strong></div>
                                        <div class="col-8">
                                            <span class="badge bg-secondary">${user.id}</span>
                                        </div>
                                        <div class="col-4"><strong>Nama:</strong></div>
                                        <div class="col-8">${user.name}</div>
                                        <div class="col-4"><strong>Email:</strong></div>
                                        <div class="col-8">
                                            <a href="mailto:${user.email}" class="text-decoration-none">${user.email}</a>
                                        </div>
                                        <div class="col-4"><strong>Role:</strong></div>
                                        <div class="col-8">
                                            <span class="badge bg-success">Pelamar</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <h6 class="card-title border-bottom pb-2 mb-3">
                                        <i class="fas fa-clock me-2"></i>Informasi Waktu
                                    </h6>
                                    <div class="row g-2">
                                        <div class="col-5"><strong>Terdaftar:</strong></div>
                                        <div class="col-7">
                                            <small>
                                                ${new Date(user.created_at).toLocaleDateString('id-ID', {
                                                    year: 'numeric',
                                                    month: 'long',
                                                    day: 'numeric'
                                                })}<br>
                                                ${new Date(user.created_at).toLocaleTimeString('id-ID', {
                                                    hour: '2-digit',
                                                    minute: '2-digit'
                                                })}
                                            </small>
                                        </div>
                                        <div class="col-5"><strong>Update:</strong></div>
                                        <div class="col-7">
                                            <small>
                                                ${new Date(user.updated_at).toLocaleDateString('id-ID', {
                                                    year: 'numeric',
                                                    month: 'long',
                                                    day: 'numeric'
                                                })}<br>
                                                ${new Date(user.updated_at).toLocaleTimeString('id-ID', {
                                                    hour: '2-digit',
                                                    minute: '2-digit'
                                                })}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ${additionalData}
                `;
                
                $('#detailModalBody').html(detailHtml);
            } else {
                $('#detailModalBody').html(`
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>${response.message}
                    </div>
                `);
            }
        },
        error: function(xhr) {
            const errorMessage = xhr.responseJSON?.message || 'Terjadi kesalahan saat mengambil detail pelamar';
            $('#detailModalBody').html(`
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>${errorMessage}
                </div>
            `);
        }
    });
}

// Alert function with Bootstrap styling
function showAlert(type, message) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
    
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <i class="fas ${iconClass} me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    
    $('#alertContainer').html(alertHtml);
    
    // Auto dismiss after 5 seconds
    setTimeout(() => {
        $('.alert').fadeOut();
    }, 5000);
}
</script>
@endpush
@endsection