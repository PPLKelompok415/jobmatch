<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Services\JobMatchingService;

class JobMatchingController extends Controller
{
    public function match($id, JobMatchingService $service)
    {
        $applicant = Applicant::findOrFail($id);
        $matchedJobs = $service->match($applicant);

        return view('jobs.matched', compact('applicant', 'matchedJobs'));
    }
}
