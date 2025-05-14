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
use App\Http\Controllers\DashboardCompanyController;
use App\Http\Controllers\DashboardApplicantController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Home Route
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

// Super Admin
Route::get('login/admin', [LoginSuperAdminController::class, 'showLoginForm'])->name('login.admin');
Route::post('login/admin', [LoginSuperAdminController::class, 'login'])->name('login.admin.post');

// ==============================
// Dashboard Routes
// ==============================

Route::middleware('auth')->get('/company/daCompany', [DashboardCompanyController::class, 'showDashboard'])->name('company.dashboard');
Route::middleware('auth')->get('/applicant/dashboard', [DashboardApplicantController::class, 'index'])->name('applicant.dashboard');

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

// Versi chat dengan receiver
Route::middleware(['auth'])->group(function () {
    Route::get('/chat/{receiver}', [ChatController::class, 'index'])->name('chat.with');
    Route::post('/chat/send', [ChatController::class, 'store'])->name('chat.send');
});

// ==============================
// Bookmark
// ==============================

Route::get('/bookmark', function () {
    return view('job-matching.bookmark');
})->name('bookmark');

Route::get('/bookmark2', function () {
    return view('job-matching.bookmark2');
})->name('bookmark_2');

// ==============================
// Company Home
// ==============================

Route::get('/Company', [CompanyHomeController::class, 'index'])->name('CompanyHome');
