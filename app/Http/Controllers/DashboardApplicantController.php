<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class DashboardApplicantController extends Controller
{
          public function index()
          {
              $matchingJobs = collect(); // atau ambil data dari database
              $noMatchingJobs = collect();
              return view('applicant.daApplicant', compact('matchingJobs', 'noMatchingJobs'));
          }

          public function showRatingForm()
          {
              return view('applicant.rating'); // Mengarahkan ke view rating
          }
}