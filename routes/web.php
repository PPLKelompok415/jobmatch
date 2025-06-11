<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterCompanyController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginCompanyController;
use App\Http\Controllers\Auth\LoginApplicantController;
use App\Http\Controllers\Auth\LoginSuperAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyHomeController; // Mungkin tidak terpakai lagi
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DashboardCompanyController;
use App\Http\Controllers\JobMatchingController;
use App\Http\Controllers\Applicant\JobApplyController;
use App\Http\Controllers\DashboardApplicantController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommunityCommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController; // Pastikan JobController di-import
use App\Http\Controllers\BookmarkController; // Pastikan BookmarkController di-import
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Livewire\Chat;
use App\Livewire\ChatList;


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

// =====================================================================
// ROUTE AUTENTIKASI (LOGIN & REGISTER)
// =====================================================================

// Register Company Routes
Route::get('register/company', [RegisterCompanyController::class, 'showRegistrationForm'])->name('register.company');
Route::post('register/company', [RegisterCompanyController::class, 'register'])->name('register.company.post');

// Login Routes for Company
Route::get('login/company', [LoginCompanyController::class, 'showLoginForm'])->name('login.company');
Route::post('login/company', [LoginCompanyController::class, 'login'])->name('company.login.post');
Route::get('/company-home', function() {
    return redirect()->route('jobs.index'); // Mengarahkan ke daftar jobs umum
})->name('CompanyHome');

// Register Applicant Routes
Route::get('register/applicant', [RegisterController::class, 'showRegistrationForm'])->name('register.applicant');
Route::post('register/applicant', [RegisterController::class, 'register'])->name('register.applicant.post');

// Login Routes for Applicant
Route::get('login/applicant', [LoginApplicantController::class, 'showLoginForm'])->name('login.applicant');
Route::post('login/applicant', [LoginApplicantController::class, 'login'])->name('applicant.login.post');

// Login Super Admin Route
Route::get('login/admin', [LoginSuperAdminController::class, 'showLoginForm'])->name('login.admin');
Route::post('login/admin', [LoginSuperAdminController::class, 'login'])->name('login.admin.post');

// Logout Route (generik untuk semua jenis user, menggunakan LoginApplicantController's logout)
Route::post('logout', [LoginApplicantController::class, 'logout'])->name('logout');


// =====================================================================
// ROUTE YANG MEMERLUKAN AUTENTIKASI (MIDDLEWARE 'AUTH')
// =====================================================================
Route::middleware('auth')->group(function () {

    // Dashboard Company
    Route::get('/company/dashboard', [DashboardCompanyController::class, 'showDashboard'])->name('company.dashboard');
    // Jika Anda punya /company/daCompany, pastikan rute ini tetap ada jika diperlukan secara langsung
    // Route::get('/company/daCompany', [DashboardCompanyController::class, 'showDashboard'])->name('company.dashboard.daCompany');

    // Company Job Management (menggunakan JobController untuk CRUD job)
    Route::get('/company/job/create', [JobController::class, 'create'])->name('company.job.create');
    Route::post('/company/job/store', [JobController::class, 'store'])->name('company.job.store');

    // Route untuk melihat detail lowongan, edit, update, delete
    // Ini adalah rute yang akan digunakan dari dashboard perusahaan
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show'); // Menampilkan detail lowongan
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit'); // Menampilkan form edit lowongan
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update'); // Update lowongan
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy'); // Hapus lowongan

    // Rute Aplikasi Lowongan untuk Perusahaan
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

    // Chat (Livewire components)
    Route::get('/chat/{user}/{job}', Chat::class)->name('chat.show');
    Route::get('/chat', ChatList::class)->name('chat.index');
    Route::get('/chat/company', function () {
        return view('job-matching.companychat'); // Pastikan view ini ada
    })->name('chat_company');
    
    // Bookmark
    Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark.index');
    Route::post('/bookmark/store', [BookmarkController::class, 'store'])->name('bookmark.store');
    Route::delete('/bookmark/{id}', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');

    // Job Matching
    Route::get('/job-matching', [JobMatchingController::class, 'index'])->name('job-matching');
    Route::post('/jobs/apply', [JobApplyController::class, 'apply'])->name('jobs.apply');

    // Community
    Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
    Route::post('/community', [CommunityController::class, 'store'])->name('community.store');
    Route::post('/bookmark/{bookmark}/comment', [CommentController::class, 'store'])->name('bookmark.comment.store');
    Route::post('/community/{community}/comment', [CommunityCommentController::class, 'store'])->name('community.comment.store');
    Route::post('/community/{id}/like', [CommunityController::class, 'like'])->name('community.like');
    Route::get('/community/liked-comments', [CommunityController::class, 'likedComments'])->name('community.liked.comments');
    Route::delete('/community/{id}', [CommunityController::class, 'destroy'])->name('community.destroy');

    // Rute Profil Pengguna (Applicant)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // =====================================================================
    // RUTE UMUM UNTUK LOWONGAN PEKERJAAN (JobController)
    // =====================================================================
    // Ini adalah rute untuk tampilan daftar lowongan pekerjaan yang bisa diakses publik
    // atau oleh applicant
    Route::get('/jobs/{company?}', [JobController::class, 'index'])->name('jobs.index');


    // =====================================================================
    // RUTE UNTUK MENGELOLA DATA PERUSAHAAN (COMPANY) MENGGUNAKAN JOBCONTROLLER
    // =====================================================================
    // Ini adalah rute yang akan digunakan untuk mengelola profil perusahaan.
    // 'companies.show' mungkin bisa di luar 'auth' jika ini halaman profil publik perusahaan.
    Route::get('/companies/{company}', [JobController::class, 'showCompany'])->name('companies.show');
    Route::get('/companies/{company}/edit', [JobController::class, 'editCompany'])->name('companies.edit');
    Route::put('/companies/{company}', [JobController::class, 'updateCompany'])->name('companies.update');
    Route::delete('/companies/{company}', [JobController::class, 'destroyCompany'])->name('companies.destroy');

    // =====================================================================
    // Rute untuk Admin Dashboard
    // =====================================================================
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard utama
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Halaman terpisah untuk setiap menu
        Route::get('/applicants', [AdminDashboardController::class, 'applicants'])->name('applicants');
        Route::get('/companies', [AdminDashboardController::class, 'companies'])->name('companies');
        Route::get('/job-postings', [AdminDashboardController::class, 'jobPostings'])->name('job-postings');
        
        // AJAX Routes
        Route::delete('/users/{user}', [AdminDashboardController::class, 'deleteUser'])->name('users.delete');
        Route::get('/users/{user}/detail', [AdminDashboardController::class, 'getUserDetail'])->name('users.detail');
        Route::get('/users/by-role/{role}', [AdminDashboardController::class, 'getUsersByRole'])->name('users.by-role');
        
        // Job Management Routes for Admin
        Route::get('/jobs', [AdminDashboardController::class, 'jobPostings'])->name('jobs.index'); // Duplikasi nama rute jobs.index
        Route::get('/jobs/filter', [AdminDashboardController::class, 'filterJobs'])->name('jobs.filter');
        Route::get('/jobs/statistics', [AdminDashboardController::class, 'getJobStatistics'])->name('jobs.statistics');
        Route::get('/jobs/{job}', [AdminDashboardController::class, 'showJob'])->name('jobs.show'); // Duplikasi nama rute jobs.show
        Route::delete('/jobs/{job}', [AdminDashboardController::class, 'deleteJob'])->name('jobs.destroy'); // Duplikasi nama rute jobs.destroy

        // Company Search Route (Admin)
        Route::get('/companies/search', [AdminDashboardController::class, 'searchCompanies'])->name('companies.search');
    });
});
