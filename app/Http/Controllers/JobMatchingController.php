<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class JobMatchingController extends Controller
{
    public function index()
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login'); // Mengarahkan ke halaman login jika belum login
        }

        // Pencocokan pekerjaan berdasarkan keterampilan, lokasi, dan jenis pekerjaan
        $matchedJobs = Job::whereHas('skills', function ($query) use ($user) {
            // Mencocokkan pekerjaan berdasarkan skill yang dimiliki pengguna
            $query->whereIn('skill_id', $user->skills->pluck('id'));
        })
        ->where('location', $user->location)  // Filter berdasarkan lokasi pengguna
        ->where('type_of_work', $user->preferred_type_of_work)  // Filter berdasarkan tipe pekerjaan yang diinginkan
        ->get();

        // Menghitung match score untuk setiap pekerjaan
        $matchedJobs->each(function ($job) use ($user) {
            $matchScore = 0;

            // Menghitung match score berdasarkan skill
            foreach ($user->skills as $skill) {
                if ($job->skills->contains($skill)) {
                    $matchScore += 10;  // Tambahkan poin jika skill cocok
                }
            }

            // Menghitung match score berdasarkan lokasi
            if ($job->location == $user->location) {
                $matchScore += 5;  // Tambahkan poin jika lokasi cocok
            }

            // Menghitung match score berdasarkan jenis pekerjaan
            if ($job->type_of_work == $user->preferred_type_of_work) {
                $matchScore += 5;  // Tambahkan poin jika tipe pekerjaan cocok
            }

            // Set match score ke pekerjaan
            $job->match_score = $matchScore;
        });

        // Kirim data pekerjaan yang cocok ke view
        return view('job_matching', ['matchedJobs' => $matchedJobs]);
    }
}
