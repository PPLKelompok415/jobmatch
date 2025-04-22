<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class DashboardApplicantController extends Controller
{
          public function index()
          {
              // Mengambil semua perusahaan dengan pekerjaan yang terkait
              $companies = Company::with('jobs')->get();
          
              // Memisahkan pekerjaan yang cocok dan tidak cocok
              $matchingJobs = $companies->flatMap(function ($company) {
                  return $company->jobs->filter(function ($job) {
                      // Pencocokan berdasarkan match_score
                      return $job->match_score >= 80;
                  });
              });
          
              $noMatchingJobs = $companies->flatMap(function ($company) {
                  return $company->jobs->filter(function ($job) {
                      return $job->match_score < 80;
                  });
              });
          
              // Mengirimkan data ke view
              return view('applicant.daApplicant', [
                  'matchingJobs' => $matchingJobs,
                  'noMatchingJobs' => $noMatchingJobs,
              ]);
          }
          
}          