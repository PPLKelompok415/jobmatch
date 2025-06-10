<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterCompanyController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginCompanyController;
use App\Http\Controllers\Auth\LoginApplicantController;
use App\Http\Controllers\Auth\LoginSuperAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CompanyHomeController;
use App\livewire\Chat;
use App\livewire\ChatList;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DashboardCompanyController;
use App\Http\Controllers\JobMatchingController;
use App\Http\Controllers\Applicant\JobApplyController;
use App\Http\Controllers\DashboardApplicantController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommunityCommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Applicant Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// ROUTE BUAT COMPANY DISINI !
// Company Home Route
Route::get('/Company', [CompanyHomeController::class, 'index'])->name('CompanyHome');

// Register Company Routes
Route::get('register/company', [RegisterCompanyController::class, 'showRegistrationForm'])->name('register.company');
Route::post('register/company', [RegisterCompanyController::class, 'register'])->name('register.company.post');

// Login Routes for Company
Route::get('login/company', [LoginCompanyController::class, 'showLoginForm'])->name('login.company');
Route::post('login/company', [LoginCompanyController::class, 'login'])->name('company.login.post');
Route::middleware('auth')->get('/company/daCompany', [DashboardCompanyController::class, 'showDashboard'])->name('company.dashboard');

// Tambahkan route ini untuk company dashboard yang lebih standar
Route::middleware('auth')->get('/company/dashboard', [DashboardCompanyController::class, 'showDashboard'])->name('company.dashboard.alternative');

Route::middleware('auth')->group(function () {
    Route::get('/company/job/create', [CompanyHomeController::class, 'createJob'])->name('company.job.create');
    Route::post('/company/job/store', [CompanyHomeController::class, 'storeJob'])->name('company.job.store');

     Route::get('company/jobs/{job}/applicants', [DashboardCompanyController::class, 'showApplicants'])
        ->name('company.job.applicants');
        
    Route::put('/applications/{application}', [DashboardCompanyController::class, 'updateApplicationStatus'])
        ->name('company.applications.update');
});

// ROUTE BUAT APPLICANT DISINI !
// Register Applicant (applicant) Routes
Route::get('register/applicant', [RegisterController::class, 'showRegistrationForm'])->name('register.applicant');
Route::post('register/applicant', [RegisterController::class, 'register'])->name('register.applicant.post');

// ==============================
// Login Routes
// ==============================

// Company
Route::get('login/company', [LoginCompanyController::class, 'showLoginForm'])->name('login.company');
Route::post('login/company', [LoginCompanyController::class, 'login'])->name('company.login.post');

// Applicant
Route::get('login/applicant', [LoginApplicantController::class, 'showLoginForm'])->name('login.applicant');
Route::post('login/applicant', [LoginApplicantController::class, 'login'])->name('applicant.login.post');

Route::middleware('auth')->group(function () {
    Route::get('/applicant/dashboard', [DashboardApplicantController::class, 'index'])
         ->name('applicant.dashboard');
    // Endpoint JSON untuk fetch via Alpine
    Route::get('/applicant/dashboard/data', [DashboardApplicantController::class, 'data'])
         ->name('applicant.dashboard.data');
    
    Route::post('/applicant/jobs/apply', [DashboardApplicantController::class, 'applyJob'])->name('applicant.jobs.apply');
    Route::get('/applicant/findjobs', [DashboardApplicantController::class, 'findJobs'])->name('applicant.findjobs');
    Route::get('/applicant/jobs/{job}', [DashboardApplicantController::class, 'viewJobDetails'])->name('applicant.jobs.details');

    // Chat
    Route::get('/chat/{user}/{job}', Chat::class)->name('chat.show');
    Route::get('/chat', ChatList::class)->name('chat.index');
    
    // Bookmark
    Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark.index');
    Route::post('/bookmark/store', [BookmarkController::class, 'store'])->name('bookmark.store');
    Route::delete('/bookmark/{id}', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');

});

// Rute untuk logout
Route::post('/logout', [LoginApplicantController::class, 'logout'])->name('logout');

// ROUTE BUAT SUPER ADMIN DISINI !
// Login Super Admin Route
Route::get('login/admin', [LoginSuperAdminController::class, 'showLoginForm'])->name('login.admin');
Route::post('login/admin', [LoginSuperAdminController::class, 'login'])->name('login.admin.post');

// Admin Routes - Updated dengan halaman terpisah
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    // Dashboard utama
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Halaman terpisah untuk setiap menu
    Route::get('/applicants', [AdminDashboardController::class, 'applicants'])->name('applicants');
    Route::get('/companies', [AdminDashboardController::class, 'companies'])->name('companies');
    Route::get('/job-postings', [AdminDashboardController::class, 'jobPostings'])->name('job-postings');
    
    // AJAX Routes (tetap dipertahankan untuk modal dan operasi AJAX)
    Route::delete('/users/{user}', [AdminDashboardController::class, 'deleteUser'])->name('users.delete');
    Route::get('/users/{user}/detail', [AdminDashboardController::class, 'getUserDetail'])->name('users.detail');
    Route::get('/users/by-role/{role}', [AdminDashboardController::class, 'getUsersByRole'])->name('users.by-role');
    
    // Optional: Routes tambahan untuk job postings jika diperlukan
    // Route::get('/job-postings/{job}/detail', [AdminDashboardController::class, 'getJobDetail'])->name('job-postings.detail');
    // Route::patch('/job-postings/{job}/status', [AdminDashboardController::class, 'updateJobStatus'])->name('job-postings.status');
    // Route::delete('/job-postings/{job}', [AdminDashboardController::class, 'deleteJob'])->name('job-postings.delete');
    
    // Job Management Routes - untuk AJAX dan operasi job
    Route::get('/jobs', [AdminDashboardController::class, 'jobPostings'])->name('jobs.index');
    Route::get('/jobs/filter', [AdminDashboardController::class, 'filterJobs'])->name('jobs.filter');
    Route::get('/jobs/statistics', [AdminDashboardController::class, 'getJobStatistics'])->name('jobs.statistics');
    Route::get('/jobs/{job}', [AdminDashboardController::class, 'showJob'])->name('jobs.show');
    Route::delete('/jobs/{job}', [AdminDashboardController::class, 'deleteJob'])->name('jobs.destroy');

    // Company Search Route (jika belum ada)
    Route::get('/companies/search', [AdminDashboardController::class, 'searchCompanies'])->name('companies.search');

});

// ==============================
// Logout
// ==============================

Route::post('logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

//jobmatching
// Route::get('/match-jobs/{id}', [JobMatchingController::class, 'match'])->name('job.match');
Route::get('/job-matching', [JobMatchingController::class, 'index'])->name('job-matching');

Route::middleware(['auth'])->group(function () {
    Route::post('/jobs/apply', [JobApplyController::class, 'apply'])->name('jobs.apply');
});

// Community
Route::middleware('auth')->group(function () {
    Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
    Route::post('/community', [CommunityController::class, 'store'])->name('community.store');
    Route::post('/bookmark/{bookmark}/comment', [CommentController::class, 'store'])->name('bookmark.comment.store');
    Route::middleware('auth')->post('/community/{community}/comment', [CommunityCommentController::class, 'store'])->name('community.comment.store');
    Route::post('/community/{id}/like', [App\Http\Controllers\CommunityController::class, 'like'])->name('community.like');
    Route::get('/community/liked-comments', [\App\Http\Controllers\CommunityController::class, 'likedComments'])->name('community.liked.comments');
    Route::delete('/community/{id}', [\App\Http\Controllers\CommunityController::class, 'destroy'])->name('community.destroy');
});