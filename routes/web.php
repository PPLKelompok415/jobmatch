<?php

use Illuminate\Support\Facades\Route;

<<<<<<< Updated upstream
Route::get('/', function () {
    return view('welcome');
});
=======
// Route::get('/', function () {
//     return view('welcome');
// });

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


// ROUTE BUAT APPLICANT DISINI !

// Register Applicant (applicant) Routes
Route::get('register/applicant', [RegisterController::class, 'showRegistrationForm'])->name('register.applicant');
Route::post('register/applicant', [RegisterController::class, 'register'])->name('register.applicant.post');

// Login Routes for Applicant
Route::get('login/applicant', [LoginApplicantController::class, 'showLoginForm'])->name('login.applicant');
Route::post('login/applicant', [LoginApplicantController::class, 'login'])->name('applicant.login.post');

Route::middleware('auth')->get('/applicant/dashboard', [DashboardApplicantController::class, 'index'])->name('applicant.dashboard');

Route::middleware('auth')->get('/applicant/dashboard/rating', [DashboardApplicantController::class, 'showRatingForm'])->name('applicant.dashboard.rating');

// Rute untuk logout
Route::post('/logout', [LoginApplicantController::class, 'logout'])->name('logout');



// ROUTE BUAT SUPER ADMIN DISINI !
// Login Super Admin Route
Route::get('login/admin', [LoginSuperAdminController::class, 'showLoginForm'])->name('login.admin');
Route::post('login/admin', [LoginSuperAdminController::class, 'login'])->name('login.admin.post');

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
>>>>>>> Stashed changes
