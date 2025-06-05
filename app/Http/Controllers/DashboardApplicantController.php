<?php

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
        $userId = auth()->id();

        if (!$applicant) {
            abort(403, 'Applicant profile not found.');
        }

        $matchedJobs = JobMatchingService::makeMatches($applicant)
                ->sortByDesc('match_score')
                ->take(4)
                ->values();

        return view('applicant.daApplicant', [
            'matchingJobs' => $matchedJobs,
            'userId' => $userId,
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
