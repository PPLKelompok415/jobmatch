@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dashboard Admin</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Statistik Pengguna -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Total Pengguna</h5>
                                    <h2 class="display-4">{{ $totalUsers }}</h2>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">Lihat Detail</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Statistik Pelamar -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Total Pelamar</h5>
                                    <h2 class="display-4">{{ $totalApplicants }}</h2>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">Lihat Detail</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Statistik Perusahaan -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Total Perusahaan</h5>
                                    <h2 class="display-4">{{ $totalCompanies }}</h2>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">Lihat Detail</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tabel Pengguna Terbaru -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-users me-1"></i>
                                    Pengguna Terbaru
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
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
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $user->role == 'applicant' ? 'success' : ($user->role == 'company' ? 'warning' : 'primary') }}">
                                                            {{ ucfirst($user->role) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-info">Detail</a>
                                                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data pengguna</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Area untuk statistik lainnya -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Pengguna Terdaftar per Bulan
                                </div>
                                <div class="card-body">
                                    <canvas id="userChart" width="100%" height="40"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    Distribusi Role Pengguna
                                </div>
                                <div class="card-body">
                                    <canvas id="roleChart" width="100%" height="40"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Letakkan variabel Laravel ke dalam variabel JavaScript
    var totalUsers = {{ $totalUsers }};
    var totalApplicants = {{ $totalApplicants }};
    var totalCompanies = {{ $totalCompanies }};
    var adminCount = {{ $totalUsers - $totalApplicants - $totalCompanies }};
    
    // Contoh data untuk chart (Anda bisa menggantinya dengan data asli)
    document.addEventListener('DOMContentLoaded', function() {
        // Chart untuk pengguna per bulan
        var ctx = document.getElementById('userChart');
        var userChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Pengguna Baru',
                    data: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, totalUsers],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Chart untuk distribusi role
        var roleCtx = document.getElementById('roleChart');
        var roleChart = new Chart(roleCtx, {
            type: 'pie',
            data: {
                labels: ['Pelamar', 'Perusahaan', 'Admin'],
                datasets: [{
                    data: [totalApplicants, totalCompanies, adminCount],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(54, 162, 235, 0.5)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    });
</script>
@endpush

@endsection