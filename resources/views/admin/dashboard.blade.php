@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin
    </h1>
    <div class="text-muted">
        <i class="fas fa-calendar-alt me-1"></i>
        {{ now()->format('d F Y') }}
    </div>
</div>

<!-- Statistics Cards Row -->
<div class="row mb-4">
    <!-- Total Users Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Pengguna
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <a href="#" onclick="showUsersByRole('all'); return false;" 
                       class="btn btn-primary btn-sm">
                        <i class="fas fa-eye me-1"></i>Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Applicants Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Pelamar
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalApplicants }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-tie fa-2x text-success"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <a href="#" onclick="showUsersByRole('applicant'); return false;" 
                       class="btn btn-success btn-sm">
                        <i class="fas fa-eye me-1"></i>Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Companies Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Perusahaan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCompanies }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-building fa-2x text-warning"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <a href="#" onclick="showUsersByRole('company'); return false;" 
                       class="btn btn-warning btn-sm">
                        <i class="fas fa-eye me-1"></i>Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Count Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Admin
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalUsers - $totalApplicants - $totalCompanies }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-shield fa-2x text-info"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <a href="#" onclick="showUsersByRole('admin'); return false;" 
                       class="btn btn-info btn-sm">
                        <i class="fas fa-eye me-1"></i>Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Recent Users Table -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-users me-2"></i>Pengguna Terbaru
                </h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Aksi:</div>
                        <a class="dropdown-item" href="#" onclick="showUsersByRole('all')">Lihat Semua</a>
                        <a class="dropdown-item" href="#" onclick="location.reload()">Refresh Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers as $user)
                            <tr id="user-row-{{ $user->id }}">
                                <td class="text-center font-weight-bold">#{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-3">
                                            <div class="avatar-initial bg-{{ $user->role == 'applicant' ? 'success' : ($user->role == 'company' ? 'warning' : 'primary') }} rounded-circle">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div>
                                            <span class="font-weight-bold">{{ $user->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge badge-{{ $user->role == 'applicant' ? 'success' : ($user->role == 'company' ? 'warning' : 'primary') }}">
                                        <i class="fas fa-{{ $user->role == 'applicant' ? 'user-tie' : ($user->role == 'company' ? 'building' : 'user-shield') }} me-1"></i>
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $user->created_at->format('d M Y') }}</small><br>
                                    <small class="text-muted">{{ $user->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-info btn-sm detail-user" 
                                                data-user-id="{{ $user->id }}" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm delete-user" 
                                                data-user-id="{{ $user->id }}" 
                                                data-user-name="{{ $user->name }}" title="Hapus User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                    Tidak ada data pengguna
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-pie me-2"></i>Distribusi Role Pengguna
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="roleChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Pelamar
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> Perusahaan
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Admin
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions Row -->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-bolt me-2"></i>Aksi Cepat
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-outline-primary btn-lg w-100" onclick="showUsersByRole('all')">
                            <i class="fas fa-users fa-2x mb-2"></i><br>
                            <span>Kelola Semua User</span>
                        </button>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-outline-success btn-lg w-100" onclick="showUsersByRole('applicant')">
                            <i class="fas fa-user-tie fa-2x mb-2"></i><br>
                            <span>Kelola Pelamar</span>
                        </button>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-outline-warning btn-lg w-100" onclick="showUsersByRole('company')">
                            <i class="fas fa-building fa-2x mb-2"></i><br>
                            <span>Kelola Perusahaan</span>
                        </button>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-outline-info btn-lg w-100" onclick="location.reload()">
                            <i class="fas fa-sync-alt fa-2x mb-2"></i><br>
                            <span>Refresh Data</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                    Konfirmasi Hapus User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <i class="fas fa-user-times fa-4x text-danger"></i>
                </div>
                <p class="lead">Apakah Anda yakin ingin menghapus user <strong id="deleteUserName" class="text-danger"></strong>?</p>
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-warning me-2"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan!
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-danger" id="confirmDelete">
                    <i class="fas fa-trash me-1"></i>Hapus User
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail User -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-user-circle me-2"></i>Detail User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailModalBody">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted">Memuat data user...</p>
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

<!-- Modal List Users by Role -->
<div class="modal fade" id="usersListModal" tabindex="-1" aria-labelledby="usersListModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="usersListModalLabel">
                    <i class="fas fa-list me-2"></i>Daftar Users
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="usersListModalBody">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted">Memuat daftar users...</p>
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

@push('styles')
<style>
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    
    .text-xs {
        font-size: 0.7rem;
    }
    
    .avatar {
        width: 2.5rem;
        height: 2.5rem;
    }
    
    .avatar-initial {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: white;
    }
    
    .card {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
        border: 1px solid rgba(33, 40, 50, 0.125);
        border-radius: 0.35rem;
    }
    
    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
    }
    
    .btn-outline-primary:hover,
    .btn-outline-success:hover,
    .btn-outline-warning:hover,
    .btn-outline-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .chart-pie {
        position: relative;
        height: 15rem;
    }
    
    .table th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge {
        font-size: 0.7rem;
        padding: 0.4rem 0.6rem;
    }
    
    .btn-group .btn {
        margin: 0 1px;
    }
    
    .text-gray-800 {
        color: #5a5c69 !important;
    }
    
    .text-gray-400 {
        color: #858796 !important;
    }
    
    .font-weight-bold {
        font-weight: 700 !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari Laravel ke JavaScript
    var totalUsers = {{ $totalUsers }};
    var totalApplicants = {{ $totalApplicants }};
    var totalCompanies = {{ $totalCompanies }};
    var adminCount = {{ $totalUsers - $totalApplicants - $totalCompanies }};
    
    // CSRF Token untuk Ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Chart
        initializeRoleChart();
        
        // Event handlers
        setupEventHandlers();
    });
    
    function initializeRoleChart() {
        var ctx = document.getElementById('roleChart').getContext('2d');
        var roleChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pelamar', 'Perusahaan', 'Admin'],
                datasets: [{
                    data: [totalApplicants, totalCompanies, adminCount],
                    backgroundColor: [
                        '#1cc88a',
                        '#f6c23e',
                        '#4e73df'
                    ],
                    borderColor: [
                        '#1cc88a',
                        '#f6c23e',
                        '#4e73df'
                    ],
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.parsed;
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = ((value / total) * 100).toFixed(1);
                                return label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    }
    
    function setupEventHandlers() {
        let userToDelete = null;
        
        // Delete user modal
        $(document).on('click', '.delete-user', function() {
            userToDelete = $(this).data('user-id');
            const userName = $(this).data('user-name');
            $('#deleteUserName').text(userName);
            $('#deleteModal').modal('show');
        });
        
        // Detail user modal
        $(document).on('click', '.detail-user', function() {
            const userId = $(this).data('user-id');
            showUserDetail(userId);
        });
        
        // Confirm delete
        $('#confirmDelete').click(function() {
            if (userToDelete) {
                deleteUser(userToDelete);
            }
        });
        
        // Reset modals
        $('#deleteModal').on('hidden.bs.modal', function() {
            userToDelete = null;
            $('#confirmDelete').prop('disabled', false).html('<i class="fas fa-trash me-1"></i>Hapus User');
        });
    }
    
    function showUserDetail(userId) {
        $('#detailModal').modal('show');
        
        // Reset modal content
        $('#detailModalBody').html(`
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Memuat data user...</p>
            </div>
        `);
        
        // Fetch user detail
        $.ajax({
            url: `/admin/users/${userId}/detail`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    const user = response.data;
                    let additionalData = '';
                    
                    // Role-specific data
                    if (user.role === 'applicant' && user.applicant_data) {
                        additionalData = `
                            <div class="col-12 mt-4">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0"><i class="fas fa-user-tie me-2"></i>Data Pelamar</h6>
                                    </div>
                                    <div class="card-body">
                                        ${user.applicant_data.phone ? `<p><strong>Telepon:</strong> ${user.applicant_data.phone}</p>` : ''}
                                        ${user.applicant_data.address ? `<p><strong>Alamat:</strong> ${user.applicant_data.address}</p>` : ''}
                                        ${user.applicant_data.education ? `<p><strong>Pendidikan:</strong> ${user.applicant_data.education}</p>` : ''}
                                        ${user.applicant_data.experience ? `<p><strong>Pengalaman:</strong> ${user.applicant_data.experience}</p>` : ''}
                                        ${Object.keys(user.applicant_data).length === 1 ? '<p class="text-muted mb-0">Belum ada data tambahan</p>' : ''}
                                    </div>
                                </div>
                            </div>
                        `;
                    } else if (user.role === 'company' && user.company_data) {
                        additionalData = `
                            <div class="col-12 mt-4">
                                <div class="card border-warning">
                                    <div class="card-header bg-warning text-white">
                                        <h6 class="mb-0"><i class="fas fa-building me-2"></i>Data Perusahaan</h6>
                                    </div>
                                    <div class="card-body">
                                        ${user.company_data.company_name ? `<p><strong>Nama Perusahaan:</strong> ${user.company_data.company_name}</p>` : ''}
                                        ${user.company_data.industry ? `<p><strong>Industri:</strong> ${user.company_data.industry}</p>` : ''}
                                        ${user.company_data.address ? `<p><strong>Alamat:</strong> ${user.company_data.address}</p>` : ''}
                                        ${user.company_data.phone ? `<p><strong>Telepon:</strong> ${user.company_data.phone}</p>` : ''}
                                        ${user.company_data.website ? `<p><strong>Website:</strong> <a href="${user.company_data.website}" target="_blank" class="text-decoration-none">${user.company_data.website}</a></p>` : ''}
                                        ${Object.keys(user.company_data).length === 1 ? '<p class="text-muted mb-0">Belum ada data tambahan</p>' : ''}
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                    
                    const detailHtml = `
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Dasar</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center mb-3">
                                            <div class="avatar-initial bg-${user.role === 'applicant' ? 'success' : (user.role === 'company' ? 'warning' : 'primary')} rounded-circle mx-auto" style="width: 60px; height: 60px; font-size: 24px;">
                                                ${user.name.charAt(0).toUpperCase()}
                                            </div>
                                        </div>
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td class="font-weight-bold">ID:</td>
                                                <td>#${user.id}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Nama:</td>
                                                <td>${user.name}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Email:</td>
                                                <td>${user.email}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Role:</td>
                                                <td>
                                                    <span class="badge badge-${user.role === 'applicant' ? 'success' : (user.role === 'company' ? 'warning' : 'primary')}">
                                                        ${user.role.charAt(0).toUpperCase() + user.role.slice(1)}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        <h6 class="mb-0"><i class="fas fa-clock me-2"></i>Informasi Waktu</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td class="font-weight-bold">Terdaftar:</td>
                                                <td>
                                                    ${new Date(user.created_at).toLocaleDateString('id-ID', {
                                                        year: 'numeric',
                                                        month: 'long',
                                                        day: 'numeric'
                                                    })}<br>
                                                    <small class="text-muted">${new Date(user.created_at).toLocaleTimeString('id-ID')}</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Update Terakhir:</td>
                                                <td>
                                                    ${new Date(user.updated_at).toLocaleDateString('id-ID', {
                                                        year: 'numeric',
                                                        month: 'long',
                                                        day: 'numeric'
                                                    })}<br>
                                                    <small class="text-muted">${new Date(user.updated_at).toLocaleTimeString('id-ID')}</small>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            ${additionalData}
                        </div>
                    `;
                    
                    $('#detailModalBody').html(detailHtml);
                } else {
                    $('#detailModalBody').html(`
                        <div class="alert alert-danger text-center">
                            <i class="fas fa-exclamation-triangle fa-2x mb-2"></i><br>
                            ${response.message}
                        </div>
                    `);
                }
            },
            error: function(xhr) {
                const errorMessage = xhr.responseJSON?.message || 'Terjadi kesalahan saat mengambil detail user';
                $('#detailModalBody').html(`
                    <div class="alert alert-danger text-center">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i><br>
                        ${errorMessage}
                    </div>
                `);
            }
        });
    }
    
    window.showUsersByRole = function(role) {
        let title = '';
        let icon = '';
        switch(role) {
            case 'all':
                title = 'Semua Pengguna';
                icon = 'users';
                break;
            case 'applicant':
                title = 'Daftar Pelamar';
                icon = 'user-tie';
                break;
            case 'company':
                title = 'Daftar Perusahaan';
                icon = 'building';
                break;
            case 'admin':
                title = 'Daftar Admin';
                icon = 'user-shield';
                break;
            default:
                title = 'Daftar Users';
                icon = 'list';
        }
        
        $('#usersListModalLabel').html(`<i class="fas fa-${icon} me-2"></i>${title}`);
        $('#usersListModal').modal('show');
        
        // Reset modal content
        $('#usersListModalBody').html(`
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Memuat daftar users...</p>
            </div>
        `);
        
        // Fetch users by role
        $.ajax({
            url: `/admin/users/by-role/${role}`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    const users = response.data;
                    
                    if (users.length === 0) {
                        $('#usersListModalBody').html(`
                            <div class="text-center py-5">
                                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">Tidak ada data</h5>
                                <p class="text-muted">Tidak ada user untuk kategori ini</p>
                            </div>
                        `);
                        return;
                    }
                    
                    let tableHtml = `
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                    `;
                    
                    users.forEach(user => {
                        const roleClass = user.role === 'applicant' ? 'success' : (user.role === 'company' ? 'warning' : 'primary');
                        const roleIcon = user.role === 'applicant' ? 'user-tie' : (user.role === 'company' ? 'building' : 'user-shield');
                        const createdAt = new Date(user.created_at).toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric'
                        });
                        
                        tableHtml += `
                            <tr id="modal-user-row-${user.id}">
                                <td class="font-weight-bold">#${user.id}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-3">
                                            <div class="avatar-initial bg-${roleClass} rounded-circle">
                                                ${user.name.charAt(0).toUpperCase()}
                                            </div>
                                        </div>
                                        <span class="font-weight-bold">${user.name}</span>
                                    </div>
                                </td>
                                <td>${user.email}</td>
                                <td>
                                    <span class="badge badge-${roleClass}">
                                        <i class="fas fa-${roleIcon} me-1"></i>
                                        ${user.role.charAt(0).toUpperCase() + user.role.slice(1)}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">${createdAt}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-info btn-sm detail-user" 
                                                data-user-id="${user.id}" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm delete-user" 
                                                data-user-id="${user.id}" 
                                                data-user-name="${user.name}" title="Hapus User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                    
                    tableHtml += `
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <small class="text-muted">Total: <strong>${users.length}</strong> user(s)</small>
                            <button class="btn btn-outline-primary btn-sm" onclick="location.reload()">
                                <i class="fas fa-sync-alt me-1"></i>Refresh Data
                            </button>
                        </div>
                    `;
                    
                    $('#usersListModalBody').html(tableHtml);
                } else {
                    $('#usersListModalBody').html(`
                        <div class="alert alert-danger text-center">
                            <i class="fas fa-exclamation-triangle fa-2x mb-2"></i><br>
                            ${response.message}
                        </div>
                    `);
                }
            },
            error: function(xhr) {
                const errorMessage = xhr.responseJSON?.message || 'Terjadi kesalahan saat mengambil data users';
                $('#usersListModalBody').html(`
                    <div class="alert alert-danger text-center">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i><br>
                        ${errorMessage}
                    </div>
                `);
            }
        });
    }
    
    function deleteUser(userId) {
        $.ajax({
            url: `/admin/users/${userId}`,
            type: 'DELETE',
            beforeSend: function() {
                $('#confirmDelete').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Menghapus...');
            },
            success: function(response) {
                if (response.success) {
                    // Remove from main table
                    $(`#user-row-${userId}`).fadeOut(500, function() {
                        $(this).remove();
                        
                        // Check if table is empty
                        if ($('#usersTable tbody tr').length === 0) {
                            $('#usersTable tbody').html(`
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                        Tidak ada data pengguna
                                    </td>
                                </tr>
                            `);
                        }
                    });
                    
                    // Remove from modal table if exists
                    $(`#modal-user-row-${userId}`).fadeOut(500, function() {
                        $(this).remove();
                    });
                    
                    // Hide modal
                    $('#deleteModal').modal('hide');
                    
                    // Show success message
                    showAlert('success', response.message);
                    
                    // Refresh after delay
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    showAlert('error', response.message);
                }
            },
            error: function(xhr) {
                const errorMessage = xhr.responseJSON?.message || 'Terjadi kesalahan saat menghapus user';
                showAlert('error', errorMessage);
            },
            complete: function() {
                $('#confirmDelete').prop('disabled', false).html('<i class="fas fa-trash me-1"></i>Hapus User');
            }
        });
    }
    
    function showAlert(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const icon = type === 'success' ? 'check-circle' : 'exclamation-triangle';
        
        const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show shadow" role="alert">
                <i class="fas fa-${icon} me-2"></i>
                <strong>${type === 'success' ? 'Berhasil!' : 'Error!'}</strong> ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        // Insert at top of page
        $('body').prepend(`
            <div class="position-fixed" style="top: 20px; right: 20px; z-index: 9999;">
                ${alertHtml}
            </div>
        `);
        
        // Auto remove
        setTimeout(() => {
            $('.alert').fadeOut();
        }, 5000);
    }
</script>
@endpush

@endsection