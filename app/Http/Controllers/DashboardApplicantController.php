<?php

namespace App\Http\Controllers;

use App\Services\JobMatchingService;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Models\Bookmark;
use App\Models\User;

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

        $matchedJobs = $matchedJobs->map(function ($job) use ($userId) {
            $companyUserId = $job->company->user_id ?? null;
            $jobId = $job->id;
            $hasChat = false;
            if ($companyUserId && $jobId) {
                $hasChat = Message::where(function($q) use ($userId, $companyUserId, $jobId) {
                    $q->where('sender_id', $userId)->where('receiver_id', $companyUserId)->where('job_id', $jobId);
                })->orWhere(function($q) use ($userId, $companyUserId, $jobId) {
                    $q->where('sender_id', $companyUserId)->where('receiver_id', $userId)->where('job_id', $jobId);
                })->exists();
            }
            $job->has_chat = $hasChat;
            $job->is_bookmarked = Bookmark::where('user_id', $userId)->where('job_id', $job->id)->exists();

            return $job;
        });

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

        $matchedJobs = $matchedJobs->map(function ($job) use ($userId) {
            $companyUserId = $job->company->user_id ?? null;
            $jobId = $job->id;
            $hasChat = false;
            if ($companyUserId && $jobId) {
                $hasChat = Message::where(function($q) use ($userId, $companyUserId, $jobId) {
                    $q->where('sender_id', $userId)->where('receiver_id', $companyUserId)->where('job_id', $jobId);
                })->orWhere(function($q) use ($userId, $companyUserId, $jobId) {
                    $q->where('sender_id', $companyUserId)->where('receiver_id', $userId)->where('job_id', $jobId);
                })->exists();
            }
            $job->has_chat = $hasChat;
            return $job;
        });

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
