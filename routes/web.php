<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterCompanyController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginCompanyController;
use App\Http\Controllers\Auth\LoginApplicantController;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Register Company Routes
Route::get('register/company', [RegisterCompanyController::class, 'showRegistrationForm'])->name('register.company');
Route::post('register/company', [RegisterCompanyController::class, 'register'])->name('register.company.post');

// Register Applicant (applicant) Routes
Route::get('register/applicant', [RegisterController::class, 'showRegistrationForm'])->name('register.applicant');
Route::post('register/applicant', [RegisterController::class, 'register'])->name('register.applicant.post');


// Login Routes for Company and Applicant
Route::get('login/company', [LoginCompanyController::class, 'showLoginForm'])->name('login.company');
Route::post('login/company', [LoginCompanyController::class, 'login'])->name('login.company');


Route::get('login/applicant', [LoginApplicantController::class, 'showLoginForm'])->name('login.applicant');
Route::post('login/applicant', [LoginApplicantController::class, 'login'])->name('applicant.login.post');
