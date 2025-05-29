<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterCompanyController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginCompanyController;
use App\Http\Controllers\Auth\LoginApplicantController;
use App\Http\Controllers\Auth\LoginSuperAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CompanyHomeController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DashboardCompanyController;
use App\Http\Controllers\DashboardApplicantController;
use App\Http\Controllers\JobMatchingController;
use App\Http\Controllers\Applicant\JobApplyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;       



// Applicant Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// ==============================
// Register Routes
// ==============================

// Register Company Routes
Route::get('register/company', [RegisterCompanyController::class, 'showRegistrationForm'])->name('register.company');
Route::post('register/company', [RegisterCompanyController::class, 'register'])->name('register.company.post');

// Register Applicant Routes
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
});

// Rute untuk logout
Route::post('/logout', [LoginApplicantController::class, 'logout'])->name('logout');



// ROUTE BUAT SUPER ADMIN DISINI !
// Login Super Admin Route
Route::get('login/admin', [LoginSuperAdminController::class, 'showLoginForm'])->name('login.admin');
Route::post('login/admin', [LoginSuperAdminController::class, 'login'])->name('login.admin.post');

// ==============================
// Dashboard Routes
// ==============================

Route::middleware('auth')->get('/company/daCompany', [DashboardCompanyController::class, 'showDashboard'])->name('company.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/applicant/dashboard', [DashboardApplicantController::class, 'index'])->name('applicant.dashboard');
    Route::get('/applicant/dashboard/data', [DashboardApplicantController::class, 'data'])->name('applicant.dashboard.data');
    Route::get('/chat/{receiver}', [ChatController::class, 'index'])->name('chat.with');
    Route::post('/chat/send', [ChatController::class, 'store'])->name('chat.send');
    Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark.index');
    Route::post('/bookmark/save', [BookmarkController::class, 'save'])->name('bookmark.save');

});

// Admin Dashboard (without role middleware yet)
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
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

// ==============================
// Chat
// ==============================

Route::get('/chat', [ChatController::class, 'index'])->name('chat');
Route::get('/chat/company', function () {
    return view('job-matching.companychat');
})->name('chat_company');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/chat/{receiver}', [ChatController::class, 'index'])->name('chat.with');
//     Route::post('/chat/send', [ChatController::class, 'store'])->name('chat.send');
//     Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark.index');
//     Route::post('/bookmark/save', [BookmarkController::class, 'save'])->name('bookmark.save');
// });

// ==============================
// Bookmark
// ==============================

// Route::get('/bookmark', function () {
//     return view('job-matching.bookmark');
// })->name('bookmark');

// ==============================
// Company Home
// ==============================

Route::get('/Company', [CompanyHomeController::class, 'index'])->name('CompanyHome');

// ==============================
// Job Matching
// ==============================

Route::get('/job-matching', [JobMatchingController::class, 'index'])->name('job-matching');

Route::middleware(['auth'])->group(function () {
    Route::post('/jobs/apply', [JobApplyController::class, 'apply'])->name('jobs.apply');
});
