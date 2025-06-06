<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApplication;

class JobApplyController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
        ]);

        // Cek apakah sudah pernah apply
        $alreadyApplied = JobApplication::where('job_id', $request->job_id)
            ->where('applicant_id', auth()->user()->id)
            ->exists();

        if ($alreadyApplied) {
            return response()->json(['message' => 'You already applied.'], 409);
        }

        // Simpan aplikasi kerja
        JobApplication::create([
            'job_id' => $request->job_id,
            'applicant_id' => auth()->user()->id,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Job application submitted successfully.']);
    }
}
