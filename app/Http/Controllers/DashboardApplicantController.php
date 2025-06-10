<?php

namespace App\Http\Controllers;

use App\Services\JobMatchingService;
use App\Models\Applicant;
use App\Models\Job;
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
        $userId = auth()->id();

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

        $alreadyApplied = DB::table('job_applications')
            ->where('job_id', $request->job_id)
            ->where('applicant_id', auth()->user()->id)
            ->exists();

        if ($alreadyApplied) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        DB::table('job_applications')->insert([
            'job_id' => $request->job_id,
            'applicant_id' => auth()->user()->id,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('applicant.jobs.details', $request->job_id)
            ->with('success', 'You have successfully applied for this job.');
    }

    public function findJobs(Request $request)
    {
        $category = $request->query('category', 'all'); // Ambil kategori dari query string, default 'all'
        $search = $request->query('search', ''); // Ambil kata kunci pencarian dari query string

        $jobsQuery = Job::with(['company', 'skills', 'requiredHardSkills', 'requiredSoftSkills']);

        if ($category !== 'all') {
            $jobsQuery->where('bidang', $category); // Filter berdasarkan kategori
        }

        if (!empty($search)) {
            $jobsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhereHas('company', function ($q) use ($search) {
                          $q->where('company_name', 'like', "%{$search}%");
                      });
            });
        }

        $jobs = $jobsQuery->paginate(10); // Pagination untuk daftar pekerjaan

        $categories = [
            'Technology' => 'Technology',
            'Finance' => 'Finance',
            'IT' => 'IT',
            'Other' => 'Other',
        ];

        return view('applicant.findjobs', compact('jobs', 'categories', 'category', 'search'));
    }

    public function viewJobDetails($jobId)
    {
        $job = Job::with('company')->findOrFail($jobId);

        $alreadyApplied = DB::table('job_applications')
            ->where('job_id', $jobId)
            ->where('applicant_id', auth()->user()->id)
            ->exists();

        return view('applicant.job-details', compact('job', 'alreadyApplied'));
    }
}
