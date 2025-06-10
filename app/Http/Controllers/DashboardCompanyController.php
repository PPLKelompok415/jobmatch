<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Diperlukan untuk Auth::user()
use App\Models\Job; // Diperlukan
use App\Models\JobApplication; // Diperlukan
use App\Models\Company; // Diperlukan, berguna untuk relasi atau akses langsung
use Illuminate\Validation\Rule; // Diperlukan untuk validasi status
use Illuminate\Support\Collection; // Diperlukan untuk inisialisasi Collection kosong

class DashboardCompanyController extends Controller
{
    /**
     * Tampilkan dashboard utama untuk perusahaan.
     * Akan langsung menampilkan daftar lowongan pekerjaan perusahaan,
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
            // Cek apakah ada profil perusahaan yang terhubung dengan user
            if ($user->company) { // Menggunakan relasi 'company' dari model User
                $companyProfileExists = true;
                // Ambil semua lowongan pekerjaan yang diposting oleh perusahaan ini
                $myJobs = Job::where('company_id', $user->company->id) // Menggunakan ID perusahaan dari relasi
                             ->with('company') // Muat relasi company dari Job
                             ->latest() // Urutkan berdasarkan yang terbaru
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
     * Menggunakan Route Model Binding untuk Job, memastikan pekerjaan ada dan milik perusahaan.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showApplicants(Job $job)
    {
        $user = Auth::user();

        // Pastikan pengguna yang login adalah perusahaan dan ini adalah pekerjaan mereka
        // ($job sudah otomatis ditemukan oleh Route Model Binding)
        if ($user && $user->role === 'company' && $user->company && $job->company_id === $user->company->id) {
            $applicants = JobApplication::where('job_id', $job->id)
                                        ->with('applicant.user') // Muat relasi applicant dan user-nya
                                        ->orderBy('applied_at', 'desc') // Urutkan berdasarkan waktu apply terbaru
                                        ->get();
            // Asumsikan view ini ada, atau sesuaikan jika nama view di cabang lain berbeda
            return view('company.job.applicants', compact('job', 'applicants')); 
        }

        // Jika tidak diizinkan, arahkan kembali atau tampilkan error
        return redirect()->back()->with('error', 'Anda tidak berhak melihat pelamar untuk lowongan ini.');
    }

    /**
     * Perbarui status aplikasi pelamar.
     * Menggunakan Route Model Binding untuk JobApplication, memastikan aplikasi ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobApplication  $application
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateApplicationStatus(Request $request, JobApplication $application)
    {
        $user = Auth::user();

        // Pastikan pengguna yang login adalah perusahaan dan ini adalah aplikasi untuk pekerjaan mereka
        // ($application sudah otomatis ditemukan oleh Route Model Binding)
        if ($user && $user->role === 'company' && $user->company && $application->job->company_id === $user->company->id) {
            $request->validate([
                // Memasukkan 'interview' sebagai status yang valid
                'status' => ['required', 'string', Rule::in(['pending', 'accepted', 'rejected', 'interview'])],
            ]);

            $application->status = $request->status;
            $application->save(); // Simpan perubahan status

            return redirect()->back()->with('success', 'Status aplikasi berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Anda tidak berhak memperbarui status aplikasi ini.');
    }
}