<?php
<<<<<<< HEAD
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
=======

namespace App\Http\Controllers;

use App\Services\JobMatchingService;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $matchedJobs = JobMatchingService::makeMatches($applicant)
                ->sortByDesc('match_score')
                ->take(4)
                ->values()
                ->toArray();

        return response()->json($matchedJobs);
    }

    /**
     * Apply ke pekerjaan tertentu (dari hasil matching).
     */
    public function applyJob(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
        ]);

        $applicant = auth()->user()->applicant;

        if (!$applicant) {
            return response()->json(['error' => 'Applicant profile not found.'], 403);
        }

        DB::table('job_applications')->updateOrInsert(
            ['applicant_id' => $applicant->id, 'job_id' => $request->job_id],
            ['applied_at' => now()]
        );

        return response()->json(['message' => 'Job applied successfully.']);
    }
}
>>>>>>> 444ce53668917cfcdb35b6f1d9804f9881ccbd6b
