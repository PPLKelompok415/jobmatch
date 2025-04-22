<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterCompanyController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginCompanyController;
use App\Http\Controllers\Auth\LoginApplicantController;
use App\Http\Controllers\Auth\LoginSuperAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyHomeController; // Ensure this controller exists in the specified namespace
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Route::get('/', function () {
//     return view('welcome');
// });

// Applicant Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');
// Company Home Route
Route::get('/Company', [CompanyHomeController::class, 'index'])->name('CompanyHome');

// Register Company Routes
Route::get('register/company', [RegisterCompanyController::class, 'showRegistrationForm'])->name('register.company');
Route::post('register/company', [RegisterCompanyController::class, 'register'])->name('register.company.post');

// Register Applicant (applicant) Routes
Route::get('register/applicant', [RegisterController::class, 'showRegistrationForm'])->name('register.applicant');
Route::post('register/applicant', [RegisterController::class, 'register'])->name('register.applicant.post');


// Login Routes for Company and Applicant
Route::get('login/company', [LoginCompanyController::class, 'showLoginForm'])->name('login.company');
Route::post('login/company', [LoginCompanyController::class, 'login'])->name('company.login.post');


Route::get('login/applicant', [LoginApplicantController::class, 'showLoginForm'])->name('login.applicant');
Route::post('login/applicant', [LoginApplicantController::class, 'login'])->name('applicant.login.post');

// super_admin

// Login Super Admin Route
Route::get('login/admin', [LoginSuperAdminController::class, 'showLoginForm'])->name('login.admin');
Route::post('login/admin', [LoginSuperAdminController::class, 'login'])->name('login.admin.post');

// // Admin Dashboard Routes (diberi middleware auth dan role)
// Route::prefix('admin')->middleware(['auth', 'role:super_admin'])->group(function () {
//     Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
//     // Rute lain untuk Super Admin
// });

// Dengan ini (tanpa middleware role dulu)
Route::prefix('admin')->middleware(['auth'])->group(function () {
          Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
      });


// Logout Route
Route::post('logout', function (Request $request) {
          Auth::logout();
          $request->session()->invalidate();
          $request->session()->regenerateToken();
          return redirect('/');
      })->name('logout');

// Chat 
Route::get('/chat', function () {
    return view('job-matching.chat');
})->name('chat');

Route::get('/chat/company', function () {
    return view('job-matching.companychat');
})->name('chat_company');

//Bookmark
Route::get('/bookmark', function () {
    return view('job-matching.bookmark');
})->name('bookmark');
