<?php

namespace App\Http\Controllers;

use App\Services\JobMatchingService;
use App\Models\Applicant;
use App\Models\Job; // Ditambahkan: Model Job diperlukan untuk fungsi findJobs dan viewJobDetails dari cabang main
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
        // Menggunakan relasi 'applicant' yang konsisten seperti di User.php yang sudah digabungkan
        $applicant = auth()->user()->applicant; 

        if (!$applicant) {
            // Memberikan respons error yang lebih spesifik jika profil pelamar tidak ditemukan
            abort(403, 'Applicant profile not found. Please ensure your applicant profile is complete.');
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
        // Menggunakan relasi 'applicant' yang konsisten
        $applicant = auth()->user()->applicant; 

        if (!$applicant) {
            // Memberikan respons JSON error jika profil pelamar tidak ditemukan
            return response()->json(['error' => 'Applicant profile not found. Please complete your profile.'], 403);
        }

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

        // Menggunakan relasi 'applicant' yang konsisten
        $applicant = auth()->user()->applicant; 

        if (!$applicant) {
            // Jika profil pelamar tidak ditemukan, redirect kembali dengan error
            return redirect()->back()->with('error', 'Applicant profile not found. Please complete your profile before applying.');
        }

        // Cek apakah pelamar sudah pernah melamar pekerjaan ini (logika dari cabang main)
        $alreadyApplied = DB::table('job_applications')
            ->where('job_id', $request->job_id)
            ->where('applicant_id', $applicant->id) // Menggunakan ID pelamar yang sudah didapatkan
            ->exists();

        if ($alreadyApplied) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        // Masukkan lamaran pekerjaan baru ke database (logika insert dari cabang main)
        DB::table('job_applications')->insert([
            'job_id' => $request->job_id,
            'applicant_id' => $applicant->id, // Menggunakan ID pelamar
            'status' => 'pending', // Status awal lamaran
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect ke halaman detail pekerjaan dengan pesan sukses (dari cabang main)
        return redirect()->route('applicant.jobs.details', $request->job_id)
            ->with('success', 'You have successfully applied for this job.');
    }

    /**
     * Fungsi untuk mencari dan memfilter pekerjaan (dari cabang main).
     */
    public function findJobs(Request $request)
    {
        $category = $request->query('category', 'all'); // Ambil kategori dari query string, default 'all'
        $search = $request->query('search', ''); // Ambil kata kunci pencarian dari query string

        // Query untuk mendapatkan pekerjaan dengan eager loading relasi
        $jobsQuery = Job::with(['company', 'skills', 'requiredHardSkills', 'requiredSoftSkills']);

        if ($category !== 'all') {
            $jobsQuery->where('bidang', $category); // Filter berdasarkan kategori
        }

        if (!empty($search)) {
            $jobsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%") // Cari di judul pekerjaan
                      ->orWhereHas('company', function ($q) use ($search) {
                          $q->where('company_name', 'like', "%{$search}%"); // Cari di nama perusahaan
                      });
            });
        }

        $jobs = $jobsQuery->paginate(10); // Pagination untuk daftar pekerjaan

        // Daftar kategori yang tersedia
        $categories = [
            'Technology' => 'Technology',
            'Finance' => 'Finance',
            'IT' => 'IT',
            'Other' => 'Other',
            // Tambahkan kategori lain sesuai kebutuhan
        ];

        return view('applicant.findjobs', compact('jobs', 'categories', 'category', 'search'));
    }

    /**
     * Fungsi untuk menampilkan detail pekerjaan (dari cabang main).
     */
    public function viewJobDetails($jobId)
    {
        // Temukan pekerjaan berdasarkan ID, dengan eager loading relasi company
        $job = Job::with('company')->findOrFail($jobId);

        // Cek apakah pelamar sudah melamar pekerjaan ini
        $alreadyApplied = DB::table('job_applications')
            ->where('job_id', $jobId)
            ->where('applicant_id', auth()->user()->id)
            ->exists();

        return view('applicant.job-details', compact('job', 'alreadyApplied'));
    }
}