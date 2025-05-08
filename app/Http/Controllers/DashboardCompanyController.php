<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class DashboardCompanyController extends Controller
{
    public function showDashboard()
    {
        // Ambil perusahaan dengan lowongan pekerjaan yang terkait
        $companies = Company::with('jobs')->get();

        // Filter pekerjaan yang cocok (match)
        $matchingJobs = $companies->flatMap(function ($company) {
            return $company->jobs->filter(function ($job) {
                // Menganggap pekerjaan cocok jika match_score >= 80
                return $job->match_score >= 80;
            });
        });

        // Filter pekerjaan yang tidak cocok
        $noMatchingJobs = $companies->flatMap(function ($company) {
            return $company->jobs->filter(function ($job) {
                return $job->match_score < 80;
            });
        });

        // Kirim data ke view
        return view('company.daCompany', [
            'matchingJobs' => $matchingJobs,
            'noMatchingJobs' => $noMatchingJobs
        ]);
    }
}
