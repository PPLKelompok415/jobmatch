<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job; // Pastikan model Job di-import
use App\Models\JobApplication; // Asumsikan Anda memiliki model JobApplication
use App\Models\Company; // Pastikan model Company di-import
use Illuminate\Validation\Rule; // Pastikan Rule di-import untuk validasi
use Illuminate\Support\Collection; // Import Collection untuk inisialisasi kosong

class DashboardCompanyController extends Controller
{
    /**
     * Tampilkan dashboard utama untuk perusahaan.
     * Sekarang akan langsung menampilkan daftar lowongan pekerjaan perusahaan,
     * atau pesan jika profil perusahaan belum lengkap / tidak ada lowongan.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showDashboard()
    {
        $user = Auth::user();
        $myJobs = new Collection(); // Inisialisasi koleksi kosong secara default
        $companyProfileExists = false; // Flag untuk melacak keberadaan profil perusahaan

        // Pastikan pengguna yang login adalah perusahaan
        if ($user && $user->role === 'company') {
            // Cek apakah ada profil perusahaan yang terhubung
            if ($user->company) {
                $companyProfileExists = true;
                // Ambil semua lowongan pekerjaan yang diposting oleh perusahaan ini
                // PENTING: Pastikan 'with('company')' ada agar relasi company dimuat
                $myJobs = Job::where('company_id', $user->company->id)
                           ->with('company') 
                           ->latest()
                           ->get();
            }

            // Selalu tampilkan view company.daCompany jika pengguna adalah perusahaan.
            // Variabel $myJobs akan berisi lowongan atau koleksi kosong.
            // Variabel $companyProfileExists akan memberi tahu view status profil.
            return view('company.daCompany', compact('myJobs', 'companyProfileExists'));
        }
        
        // Jika tidak terautentikasi atau bukan role perusahaan, arahkan ke home
        return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke dashboard perusahaan ini.');
    }

    /**
     * Tampilkan daftar pelamar untuk lowongan pekerjaan tertentu yang diposting oleh perusahaan.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showApplicants(Job $job)
    {
        $user = Auth::user();

        // Pastikan pengguna yang login adalah perusahaan dan ini adalah pekerjaan mereka
        if ($user && $user->role === 'company' && $user->company && $job->company_id === $user->company->id) {
            $applicants = JobApplication::where('job_id', $job->id)
                                        ->with('applicant.user') // Muat relasi applicant dan user-nya
                                        ->get();
            return view('company.job.applicants', compact('job', 'applicants')); // Asumsikan view ini ada
        }

        // Jika tidak diizinkan, arahkan kembali atau tampilkan error
        return redirect()->back()->with('error', 'Anda tidak berhak melihat pelamar untuk lowongan ini.');
    }

    /**
     * Perbarui status aplikasi pelamar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobApplication  $application
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateApplicationStatus(Request $request, JobApplication $application)
    {
        $user = Auth::user();

        // Pastikan pengguna yang login adalah perusahaan dan ini adalah aplikasi untuk pekerjaan mereka
        if ($user && $user->role === 'company' && $user->company && $application->job->company_id === $user->company->id) {
            $request->validate([
                'status' => ['required', 'string', Rule::in(['pending', 'accepted', 'rejected', 'interview'])],
            ]);

            $application->status = $request->status;
            $application->save();

            return redirect()->back()->with('success', 'Status aplikasi berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Anda tidak berhak memperbarui status aplikasi ini.');
    }
}
