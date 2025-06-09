<?php

namespace App\Http\Controllers;

use App\Services\JobMatchingService;
use App\Models\Applicant;
use App\Models\Job;
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
