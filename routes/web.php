<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterCompanyController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginCompanyController;
use App\Http\Controllers\Auth\LoginApplicantController;
use App\Http\Controllers\Auth\LoginSuperAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyHomeController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DashboardCompanyController;
use App\Http\Controllers\JobMatchingController;
use App\Http\Controllers\Applicant\JobApplyController;
use App\Http\Controllers\DashboardApplicantController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommunityCommentController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda. Ini
| rute dimuat oleh RouteServiceProvider dan semuanya akan
| ditetapkan ke grup middleware "web". Buat sesuatu yang hebat!
|
*/

// =====================================================================
// ROUTE UTAMA DAN UMUM
// =====================================================================

// Applicant Home Route (juga berfungsi sebagai halaman utama)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Company Home Route
Route::get('/Company', [CompanyHomeController::class, 'index'])->name('CompanyHome');


// =====================================================================
// ROUTE AUTENTIKASI (LOGIN & REGISTER)
// =====================================================================

// Register Company Routes
Route::get('register/company', [RegisterCompanyController::class, 'showRegistrationForm'])->name('register.company');
Route::post('register/company', [RegisterCompanyController::class, 'register'])->name('register.company.post');

// Login Routes for Company
Route::get('login/company', [LoginCompanyController::class, 'showLoginForm'])->name('login.company');
Route::post('login/company', [LoginCompanyController::class, 'login'])->name('company.login.post');

// Register Applicant Routes
Route::get('register/applicant', [RegisterController::class, 'showRegistrationForm'])->name('register.applicant');
Route::post('register/applicant', [RegisterController::class, 'register'])->name('register.applicant.post');

// Login Routes for Applicant
Route::get('login/applicant', [LoginApplicantController::class, 'showLoginForm'])->name('login.applicant');
Route::post('login/applicant', [LoginApplicantController::class, 'login'])->name('applicant.login.post');

// Login Super Admin Route
Route::get('login/admin', [LoginSuperAdminController::class, 'showLoginForm'])->name('login.admin');
Route::post('login/admin', [LoginSuperAdminController::class, 'login'])->name('login.admin.post');

// Logout Route (generik untuk semua jenis user)
// Dipindahkan di luar group middleware auth agar bisa diakses saat sudah login
Route::post('logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');


// =====================================================================
// ROUTE YANG MEMERLUKAN AUTENTIKASI (MIDDLEWARE 'AUTH')
// =====================================================================
Route::middleware('auth')->group(function () {

    // Dashboard Company
    Route::get('/company/daCompany', [DashboardCompanyController::class, 'showDashboard'])->name('company.dashboard');
    Route::get('/company/dashboard', [DashboardCompanyController::class, 'showDashboard'])->name('company.dashboard.alternative'); // Route alternatif

    // Company Job Management
    Route::get('/company/job/create', [CompanyHomeController::class, 'createJob'])->name('company.job.create');
    Route::post('/company/job/store', [CompanyHomeController::class, 'storeJob'])->name('company.job.store');
    Route::get('company/jobs/{job}/applicants', [DashboardCompanyController::class, 'showApplicants'])->name('company.job.applicants');
    Route::put('/applications/{application}', [DashboardCompanyController::class, 'updateApplicationStatus'])->name('company.applications.update');

    // Dashboard Applicant
    Route::get('/applicant/dashboard', [DashboardApplicantController::class, 'index'])->name('applicant.dashboard');
    // Endpoint JSON untuk fetch via Alpine
    Route::get('/applicant/dashboard/data', [DashboardApplicantController::class, 'data'])->name('applicant.dashboard.data');
    
    // Applicant Job Actions
    Route::post('/applicant/jobs/apply', [DashboardApplicantController::class, 'applyJob'])->name('applicant.jobs.apply');
    Route::get('/applicant/findjobs', [DashboardApplicantController::class, 'findJobs'])->name('applicant.findjobs');
    Route::get('/applicant/jobs/{job}', [DashboardApplicantController::class, 'viewJobDetails'])->name('applicant.jobs.details');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/applicants', [AdminDashboardController::class, 'applicants'])->name('applicants');
        Route::get('/companies', [AdminDashboardController::class, 'companies'])->name('companies');
        Route::get('/job-postings', [AdminDashboardController::class, 'jobPostings'])->name('job-postings');
        
        // AJAX Routes
        Route::delete('/users/{user}', [AdminDashboardController::class, 'deleteUser'])->name('users.delete');
        Route::get('/users/{user}/detail', [AdminDashboardController::class, 'getUserDetail'])->name('users.detail');
        Route::get('/users/by-role/{role}', [AdminDashboardController::class, 'getUsersByRole'])->name('users.by-role');
        
        // Job Management Routes for Admin (JobController logic)
        Route::get('/jobs', [AdminDashboardController::class, 'jobPostings'])->name('jobs.index'); // Admin job listings
        Route::get('/jobs/filter', [AdminDashboardController::class, 'filterJobs'])->name('jobs.filter');
        Route::get('/jobs/statistics', [AdminDashboardController::class, 'getJobStatistics'])->name('jobs.statistics');
        Route::get('/jobs/{job}', [AdminDashboardController::class, 'showJob'])->name('jobs.show');
        Route::delete('/jobs/{job}', [AdminDashboardController::class, 'deleteJob'])->name('jobs.destroy');

        // Company Search Route (Admin)
        Route::get('/companies/search', [AdminDashboardController::class, 'searchCompanies'])->name('companies.search');
    });

    // Chat
    Route::get('/chat', function () {
        return view('job-matching.chat');
    })->name('chat');
    Route::get('/chat/company', function () {
        return view('job-matching.companychat');
    })->name('chat_company');

    // Bookmark
    Route::get('/bookmark', function () {
        return view('job-matching.bookmark');
    })->name('bookmark');

    // Job Matching
    Route::get('/job-matching', [JobMatchingController::class, 'index'])->name('job-matching');
    Route::post('/jobs/apply', [JobApplyController::class, 'apply'])->name('jobs.apply'); // Ini ada di dua tempat, pastikan hanya ada satu.

    // Community
    Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
    Route::post('/community', [CommunityController::class, 'store'])->name('community.store');
    Route::post('/bookmark/{bookmark}/comment', [CommentController::class, 'store'])->name('bookmark.comment.store');
    Route::post('/community/{community}/comment', [CommunityCommentController::class, 'store'])->name('community.comment.store');
    Route::post('/community/{id}/like', [App\Http\Controllers\CommunityController::class, 'like'])->name('community.like');
    Route::get('/community/liked-comments', [\App\Http\Controllers\CommunityController::class, 'likedComments'])->name('community.liked.comments');
    Route::delete('/community/{id}', [\App\Http\Controllers\CommunityController::class, 'destroy'])->name('community.destroy');

    // Rute Profil Pengguna (Applicant dan Admin)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // =====================================================================
    // Rute Lowongan Pekerjaan Umum (JobController)
    // Digunakan untuk menampilkan daftar lowongan secara umum atau difilter oleh perusahaan
    // =====================================================================
    // Rute INDEX lowongan pekerjaan:
    // - /jobs                          -> Menampilkan semua lowongan pekerjaan
    // - /jobs?id={company_id}          -> Menampilkan lowongan pekerjaan untuk perusahaan tertentu
    // - /jobs/{company}                -> Menampilkan lowongan pekerjaan untuk perusahaan tertentu (jika {company} adalah instance Company)
    Route::get('/jobs/{company?}', [JobController::class, 'index'])->name('jobs.index');

    // Rute untuk membuat lowongan pekerjaan baru
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');

    // Rute untuk mengedit dan menghapus lowongan pekerjaan
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

    // =====================================================================
    // RUTE UNTUK MENGELOLA DATA PERUSAHAAN (COMPANY) MENGGUNAKAN JOBCONTROLLER
    // =====================================================================
    Route::get('/companies/{company}', [JobController::class, 'showCompany'])->name('companies.show');
    Route::get('/companies/{company}/edit', [JobController::class, 'editCompany'])->name('companies.edit');
    Route::put('/companies/{company}', [JobController::class, 'updateCompany'])->name('companies.update');
    Route::delete('/companies/{company}', [JobController::class, 'destroyCompany'])->name('companies.destroy');

}); // Akhir dari group middleware 'auth'