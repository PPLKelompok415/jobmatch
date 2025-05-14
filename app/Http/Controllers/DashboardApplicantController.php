<?php

namespace App\Http\Controllers;

use App\Services\JobMatchingService;
use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Models\Company;

class DashboardApplicantController extends Controller
{
    /**
     * Tampilkan halaman dashboard dengan initial matched jobs.
     */
    public function index()
    {
        /** @var \App\Models\Applicant $applicant */
        $applicant = auth()->user()->applicant;

        if (!$applicant) {
            abort(403, 'Applicant profile not found.');
        }

        $matchedJobs = JobMatchingService::makeMatches($applicant)
                ->sortByDesc('match_score')
                ->take(4)
                ->values();

        return view('applicant.daApplicant', [
            'matchingJobs' => $matchedJobs
        ]);

    }


    /**
     * Endpoint JSON untuk refresh via Alpine.js.
     */
    public function data()
    {
        /** @var Applicant $applicant **/
        $applicant = auth()->user()->applicantProfile;

        // Panggil service yang sama untuk menghitung match_score
        $matchedJobs = $matchedJobs = JobMatchingService::makeMatches($applicant)
                ->sortByDesc('match_score')
                ->take(4)
                ->values()
                ->toArray(); // Ubah ke array agar bisa di-JSON-kan

        return response()->json($matchedJobs);
    }
}
