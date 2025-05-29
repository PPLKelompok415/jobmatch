<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Applicant;
use App\Models\Company;
use App\Models\Job; // Import Job model

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            abort(403, 'Unauthorized access');
        }
        
        // Ambil data untuk ditampilkan di dashboard
        $totalUsers = User::count();
        $totalApplicants = User::where('role', 'applicant')->count();
        $totalCompanies = User::where('role', 'company')->count();
        
        // Tambahkan statistik job - menggunakan struktur database yang ada
        $totalJobs = Job::count();
        $activeJobs = Job::whereHas('company', function($query) {
            $query->where('deadline', '>=', now());
        })->count();
        $expiredJobs = Job::whereHas('company', function($query) {
            $query->where('deadline', '<', now());
        })->count();
        $pendingJobs = 0; // Bisa disesuaikan dengan logika bisnis
        
        // Data tambahan yang mungkin dibutuhkan
        $recentUsers = User::latest()->take(5)->get();
        $recentJobs = Job::with(['company'])->latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalApplicants', 
            'totalCompanies',
            'totalJobs',
            'activeJobs', 
            'pendingJobs',
            'expiredJobs',
            'recentUsers',
            'recentJobs'
        ));
    }
    
    // HALAMAN KHUSUS PELAMAR (tidak diubah)
    public function applicants()
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            abort(403, 'Unauthorized access');
        }
        
        $applicants = User::where('role', 'applicant')
                         ->with(['applicant'])
                         ->orderBy('created_at', 'desc')
                         ->paginate(20);
        
        return view('admin.applicants', compact('applicants'));
    }
    
    // HALAMAN KHUSUS PERUSAHAAN (tidak diubah)
    public function companies()
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            abort(403, 'Unauthorized access');
        }
        
        $companies = User::where('role', 'company')
                        ->with(['company'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(20);
        
        return view('admin.companies', compact('companies'));
    }
    
    // HALAMAN KHUSUS LOWONGAN KERJA - MENGGUNAKAN STRUKTUR DATABASE YANG ADA
    public function jobPostings(Request $request)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            abort(403, 'Unauthorized access');
        }
        
        // Query menggunakan struktur database yang ada
        $query = Job::with(['company']);

        // Apply search filter
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->whereHas('company', function($q) use ($searchTerm) {
                $q->where('company_name', 'like', "%{$searchTerm}%")
                  ->orWhere('position', 'like', "%{$searchTerm}%");
            });
        }

        // Apply status filter berdasarkan deadline
        if ($request->has('status') && $request->status !== 'all') {
            switch($request->status) {
                case 'active':
                    $query->whereHas('company', function($q) {
                        $q->where('deadline', '>=', now());
                    });
                    break;
                case 'expired':
                    $query->whereHas('company', function($q) {
                        $q->where('deadline', '<', now());
                    });
                    break;
            }
        }

        // Apply category filter berdasarkan type_of_work
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('company', function($q) use ($request) {
                $q->where('type_of_work', $request->category);
            });
        }

        // Apply sorting
        $sortBy = $request->get('sort', 'newest');
        switch ($sortBy) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'title_asc':
            case 'title_desc':
                // Karena title ada di tabel company, kita sort berdasarkan created_at
                $query->orderBy('created_at', $sortBy == 'title_asc' ? 'asc' : 'desc');
                break;
            case 'deadline':
                // Sort berdasarkan deadline di tabel company
                $query->join('companies', 'jobs.company_id', '=', 'companies.id')
                      ->orderBy('companies.deadline', 'asc')
                      ->select('jobs.*');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $jobs = $query->paginate(15);
        
        // Hitung statistik
        $statistics = [
            'total' => Job::count(),
            'active' => Job::whereHas('company', function($q) {
                $q->where('deadline', '>=', now());
            })->count(),
            'pending' => 0, // Bisa disesuaikan
            'expired' => Job::whereHas('company', function($q) {
                $q->where('deadline', '<', now());
            })->count()
        ];

        // Kategori berdasarkan type_of_work
        $categories = [
            'full_time' => 'Full Time',
            'part_time' => 'Part Time',
            'contract' => 'Contract',
            'freelance' => 'Freelance',
            'internship' => 'Internship'
        ];

        return view('admin.job-postings', compact('jobs', 'statistics', 'categories'));
    }
    
    // METHOD UNTUK FILTER JOBS VIA AJAX
    public function filterJobs(Request $request)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        try {
            $query = Job::with(['company']);

            // Apply search
            if ($request->has('search') && $request->search) {
                $searchTerm = $request->search;
                $query->whereHas('company', function($q) use ($searchTerm) {
                    $q->where('company_name', 'like', "%{$searchTerm}%")
                      ->orWhere('position', 'like', "%{$searchTerm}%");
                });
            }

            // Apply status filter
            if ($request->has('status') && $request->status !== 'all') {
                switch($request->status) {
                    case 'active':
                        $query->whereHas('company', function($q) {
                            $q->where('deadline', '>=', now());
                        });
                        break;
                    case 'expired':
                        $query->whereHas('company', function($q) {
                            $q->where('deadline', '<', now());
                        });
                        break;
                }
            }

            // Apply category filter
            if ($request->has('category') && $request->category !== 'all') {
                $query->whereHas('company', function($q) use ($request) {
                    $q->where('type_of_work', $request->category);
                });
            }

            // Apply sorting
            $sortBy = $request->get('sort', 'newest');
            switch ($sortBy) {
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'deadline':
                    $query->join('companies', 'jobs.company_id', '=', 'companies.id')
                          ->orderBy('companies.deadline', 'asc')
                          ->select('jobs.*');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }

            $jobs = $query->paginate(15);

            return response()->json([
                'success' => true,
                'html' => view('admin.partials.jobs-table-simple', compact('jobs'))->render(),
                'pagination' => $jobs->appends(request()->query())->links()->render()
            ]);

        } catch (\Exception $e) {
            \Log::error('Error filtering jobs: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memfilter data: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // METHOD UNTUK SHOW JOB DETAIL
    public function showJob(Job $job)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        try {
            $job->load(['company']);
            
            // Hitung statistik aplikasi (jika ada tabel job_applications)
            $applicationStats = [
                'total' => 0,
                'pending' => 0,
                'reviewing' => 0,
                'interview' => 0,
                'accepted' => 0,
                'rejected' => 0,
            ];

            // Jika ada method jobApplications di model Job
            if (method_exists($job, 'jobApplications') && $job->jobApplications) {
                $applications = $job->jobApplications;
                $applicationStats = [
                    'total' => $applications->count(),
                    'pending' => $applications->where('status', 'pending')->count(),
                    'reviewing' => $applications->where('status', 'reviewing')->count(),
                    'interview' => $applications->where('status', 'interview')->count(),
                    'accepted' => $applications->where('status', 'accepted')->count(),
                    'rejected' => $applications->where('status', 'rejected')->count(),
                ];
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'job' => $job,
                    'applicationStats' => $applicationStats,
                    'html' => view('admin.partials.job-detail-simple', compact('job', 'applicationStats'))->render()
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Error getting job detail: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail lowongan: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // METHOD UNTUK DELETE JOB
    public function deleteJob(Job $job)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        try {
            $jobTitle = $job->company->position ?? 'Lowongan';
            $job->delete();

            return response()->json([
                'success' => true,
                'message' => "Lowongan '{$jobTitle}' berhasil dihapus"
            ]);

        } catch (\Exception $e) {
            \Log::error('Error deleting job: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus lowongan: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // METHOD UNTUK GET JOB STATISTICS
    public function getJobStatistics()
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        try {
            $statistics = [
                'total' => Job::count(),
                'active' => Job::whereHas('company', function($q) {
                    $q->where('deadline', '>=', now());
                })->count(),
                'pending' => 0, // Sesuaikan dengan logika bisnis
                'expired' => Job::whereHas('company', function($q) {
                    $q->where('deadline', '<', now());
                })->count()
            ];
            
            $statistics['this_month'] = Job::whereMonth('created_at', now()->month)
                                          ->whereYear('created_at', now()->year)
                                          ->count();

            return response()->json([
                'success' => true,
                'data' => $statistics
            ]);

        } catch (\Exception $e) {
            \Log::error('Error getting job statistics: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil statistik: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // METHOD YANG SUDAH ADA (tidak diubah)
    public function deleteUser(User $user)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }
        
        if ($user->id === Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat menghapus akun Anda sendiri'
            ], 400);
        }
        
        try {
            DB::beginTransaction();
            
            if ($user->role === 'applicant') {
                Applicant::where('user_id', $user->id)->delete();
            } 
            elseif ($user->role === 'company') {
                Company::where('user_id', $user->id)->delete();
                // Hapus job postings terkait
                Job::where('company_id', function($query) use ($user) {
                    $query->select('id')->from('companies')->where('user_id', $user->id);
                })->delete();
            }
            
            $user->delete();
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => ucfirst($user->role) . ' berhasil dihapus dari sistem'
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error deleting user: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus user: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function getUserDetail(User $user)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }
        
        try {
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ];
            
            if ($user->role === 'applicant') {
                $applicant = Applicant::where('user_id', $user->id)->first();
                $userData['applicant_data'] = $applicant;
            } 
            elseif ($user->role === 'company') {
                $company = Company::where('user_id', $user->id)->first();
                $userData['company_data'] = $company;
                
                if($company) {
                    $userData['job_stats'] = [
                        'total_jobs' => Job::where('company_id', $company->id)->count(),
                        'active_jobs' => Job::where('company_id', $company->id)
                                           ->whereHas('company', function($q) {
                                               $q->where('deadline', '>=', now());
                                           })->count(),
                    ];
                }
            }
            
            return response()->json([
                'success' => true,
                'data' => $userData
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error getting user detail: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail user: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function getUsersByRole($role)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }
        
        try {
            $query = User::select('id', 'name', 'email', 'role', 'created_at')
                         ->orderBy('created_at', 'desc')
                         ->limit(100);
            
            if ($role !== 'all') {
                $query->where('role', $role);
            }
            
            $users = $query->get();
            
            return response()->json([
                'success' => true,
                'data' => $users,
                'total' => $users->count()
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error in getUsersByRole: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data users: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function searchCompanies(Request $request)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }
        
        try {
            $search = $request->get('search');
            $sort = $request->get('sort', 'newest');
            
            $query = User::where('role', 'company')->with(['company']);
            
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhereHas('company', function($companyQuery) use ($search) {
                          $companyQuery->where('company_name', 'like', "%{$search}%")
                                      ->orWhere('company_email', 'like', "%{$search}%");
                      });
                });
            }
            
            switch ($sort) {
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
            
            $companies = $query->paginate(20);
            
            return response()->json([
                'success' => true,
                'data' => $companies,
                'html' => view('admin.partials.companies-table', compact('companies'))->render()
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error in searchCompanies: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan pencarian: ' . $e->getMessage()
            ], 500);
        }
    }
}