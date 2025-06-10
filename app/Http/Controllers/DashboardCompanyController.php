<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class DashboardCompanyController extends Controller
{
    public function showDashboard()
    {
        $companyId = auth()->user()->id;

        // Get all jobs created by the logged-in company
        $myJobs = Job::with('company')
                    ->where('company_id', $companyId)
                    ->latest()
                    ->get();

        return view('Company.daCompany', [
            'myJobs' => $myJobs,
        ]);
    }

    public function showApplicants($jobId)
    {
        // Verify the job belongs to the company
        $job = Job::where('id', $jobId)
                ->where('company_id', auth()->user()->id)
                ->firstOrFail();

        // Get all applicants for this job with their details
        $applicants = JobApplication::with(['applicant.user'])
                        ->where('job_id', $jobId)
                        ->orderBy('applied_at', 'desc')
                        ->get();

        return view('company.applicants', [
            'job' => $job,
            'applicants' => $applicants
        ]);
    }

    public function updateApplicationStatus(Request $request, $applicationId)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,rejected'
        ]);

        $application = JobApplication::findOrFail($applicationId);
        
        // Verify the job belongs to the company
        $job = Job::where('id', $application->job_id)
                ->where('company_id', auth()->user()->id)
                ->firstOrFail();

        $application->update(['status' => $validated['status']]);

        return back()->with('success', 'Application status updated successfully');
    }
}
