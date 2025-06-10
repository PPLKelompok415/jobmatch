<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Applicant;
use App\Models\Company;
use App\Models\Job;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            abort(403, 'Unauthorized access');
        }
        
        // Ambil data statistik
        $totalUsers = User::count();
        $totalApplicants = User::where('role', 'applicant')->count();
        $totalCompanies = User::where('role', 'company')->count();
        
        // Tambahkan statistik job
        $totalJobs = Job::count();
        $activeJobs = Job::whereHas('company', function($query) {
            $query->where('deadline', '>=', now());
        })->count();
        $expiredJobs = Job::whereHas('company', function($query) {
            $query->where('deadline', '<', now());
        })->count();
        $pendingJobs = 0;
        
        // Ambil pengguna terbaru dengan relasi yang diperlukan (hanya 10 pertama)
        $recentUsers = User::with(['applicant', 'company'])
                          ->select('id', 'name', 'email', 'role', 'created_at', 'updated_at')
                          ->orderBy('created_at', 'desc')
                          ->limit(10)
                          ->get();
        
        // Ambil job terbaru
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
    
    // Method untuk load more users via AJAX (untuk tabel utama)
    public function getRecentUsers(Request $request)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        try {
            $page = $request->get('page', 1);
            $perPage = $request->get('per_page', 10);
            
            // Skip users yang sudah ditampilkan di halaman sebelumnya
            $skip = ($page - 1) * $perPage;
            
            $users = User::with(['applicant', 'company'])
                        ->select('id', 'name', 'email', 'role', 'created_at', 'updated_at')
                        ->orderBy('created_at', 'desc')
                        ->skip($skip)
                        ->take($perPage)
                        ->get();
            
            // Hitung total untuk pagination info
            $totalUsers = User::count();
            $currentPage = $page;
            $lastPage = ceil($totalUsers / $perPage);
            $hasMorePages = $currentPage < $lastPage;
            
            return response()->json([
                'success' => true,
                'data' => $users,
                'pagination' => [
                    'current_page' => $currentPage,
                    'last_page' => $lastPage,
                    'per_page' => $perPage,
                    'total' => $totalUsers,
                    'from' => $skip + 1,
                    'to' => min($skip + $perPage, $totalUsers),
                    'has_more' => $hasMorePages
                ]
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error getting recent users: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data users: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Method untuk get users by role dengan pagination (untuk modal)
    public function getUsersByRole($role, Request $request)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        try {
            $page = $request->get('page', 1);
            $perPage = $request->get('per_page', 15);
            
            $query = User::with(['applicant', 'company'])
                        ->select('id', 'name', 'email', 'role', 'created_at', 'updated_at')
                        ->orderBy('created_at', 'desc');
            
            // Filter berdasarkan role jika bukan 'all'
            if ($role !== 'all') {
                $validRoles = ['applicant', 'company', 'admin', 'super_admin'];
                if (in_array($role, $validRoles)) {
                    if ($role === 'admin') {
                        // Untuk admin, ambil yang role admin atau super_admin
                        $query->whereIn('role', ['admin', 'super_admin']);
                    } else {
                        $query->where('role', $role);
                    }
                }
            }
            
            $users = $query->paginate($perPage);
            
            return response()->json([
                'success' => true,
                'data' => $users->items(),
                'pagination' => [
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage(),
                    'per_page' => $users->perPage(),
                    'total' => $users->total(),
                    'from' => $users->firstItem(),
                    'to' => $users->lastItem(),
                    'has_more' => $users->hasMorePages()
                ]
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error in getUsersByRole: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data users: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Method untuk get user detail
    public function getUserDetail($id)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        try {
            $user = User::with(['applicant', 'company'])->findOrFail($id);
            
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ];
            
            // Tambahkan data spesifik berdasarkan role
            if ($user->role === 'applicant' && $user->applicant) {
                $userData['applicant_data'] = [
                    'phone' => $user->applicant->phone ?? null,
                    'address' => $user->applicant->address ?? null,
                    'education' => $user->applicant->education ?? null,
                    'experience' => $user->applicant->experience ?? null,
                    'birth_date' => $user->applicant->birth_date ?? null,
                    'gender' => $user->applicant->gender ?? null,
                ];
            } 
            elseif ($user->role === 'company' && $user->company) {
                $userData['company_data'] = [
                    'company_name' => $user->company->company_name ?? null,
                    'industry' => $user->company->industry ?? null,
                    'address' => $user->company->address ?? null,
                    'phone' => $user->company->phone ?? null,
                    'website' => $user->company->website ?? null,
                    'company_email' => $user->company->company_email ?? null,
                    'description' => $user->company->description ?? null,
                ];
                
                // Tambahan statistik job untuk company
                $userData['job_stats'] = [
                    'total_jobs' => Job::where('company_id', $user->company->id)->count(),
                    'active_jobs' => Job::where('company_id', $user->company->id)
                                       ->whereHas('company', function($q) {
                                           $q->where('deadline', '>=', now());
                                       })->count(),
                ];
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
    
    // Method untuk delete user
    public function deleteUser($id)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }
        
        try {
            $user = User::findOrFail($id);
            
            if ($user->id === Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak dapat menghapus akun Anda sendiri'
                ], 400);
            }
            
            DB::beginTransaction();
            
            $userName = $user->name;
            
            // Hapus data terkait berdasarkan role
            if ($user->role === 'applicant') {
                Applicant::where('user_id', $user->id)->delete();
            } 
            elseif ($user->role === 'company') {
                // Hapus job postings terkait terlebih dahulu
                if ($user->company) {
                    Job::where('company_id', $user->company->id)->delete();
                }
                Company::where('user_id', $user->id)->delete();
            }
            
            $user->delete();
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => "User '{$userName}' berhasil dihapus dari sistem"
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

    // Sisanya method lain tetap sama seperti sebelumnya...
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
    
    public function jobPostings(Request $request)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            abort(403, 'Unauthorized access');
        }
        
        $query = Job::with(['company']);

        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->whereHas('company', function($q) use ($searchTerm) {
                $q->where('company_name', 'like', "%{$searchTerm}%")
                  ->orWhere('position', 'like', "%{$searchTerm}%");
            });
        }

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

        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('company', function($q) use ($request) {
                $q->where('type_of_work', $request->category);
            });
        }

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
        
        $statistics = [
            'total' => Job::count(),
            'active' => Job::whereHas('company', function($q) {
                $q->where('deadline', '>=', now());
            })->count(),
            'pending' => 0,
            'expired' => Job::whereHas('company', function($q) {
                $q->where('deadline', '<', now());
            })->count()
        ];

        $categories = [
            'full_time' => 'Full Time',
            'part_time' => 'Part Time',
            'contract' => 'Contract',
            'freelance' => 'Freelance',
            'internship' => 'Internship'
        ];

        return view('admin.job-postings', compact('jobs', 'statistics', 'categories'));
    }
    
    public function filterJobs(Request $request)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        try {
            $query = Job::with(['company']);

            if ($request->has('search') && $request->search) {
                $searchTerm = $request->search;
                $query->whereHas('company', function($q) use ($searchTerm) {
                    $q->where('company_name', 'like', "%{$searchTerm}%")
                      ->orWhere('position', 'like', "%{$searchTerm}%");
                });
            }

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

            if ($request->has('category') && $request->category !== 'all') {
                $query->whereHas('company', function($q) use ($request) {
                    $q->where('type_of_work', $request->category);
                });
            }

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
    
    public function showJob(Job $job)
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        try {
            $job->load(['company']);
            
            $applicationStats = [
                'total' => 0,
                'pending' => 0,
                'reviewing' => 0,
                'interview' => 0,
                'accepted' => 0,
                'rejected' => 0,
            ];

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
                'pending' => 0,
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