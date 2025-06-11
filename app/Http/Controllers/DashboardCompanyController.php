<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job; // Pastikan ini di-import
use App\Models\Company; // Pastikan ini di-import juga

class DashboardCompanyController extends Controller
{
    /**
     * Menampilkan dashboard untuk perusahaan.
     * Mengambil lowongan pekerjaan yang terkait dengan perusahaan yang sedang login.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showDashboard()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses dashboard.');
        }

        // Pastikan user yang login memiliki relasi dengan Company
        $company = Auth::user()->company;

        if (!$company) {
            // Jika user tidak memiliki company, arahkan ke halaman pembuatan profil perusahaan
            // atau berikan pesan error.
            // Sesuaikan rute ini jika Anda memiliki rute lain untuk membuat/mengedit profil perusahaan.
            return redirect()->route('Company.profile.create')->with('error', 'Lengkapi profil perusahaan Anda terlebih dahulu.');
        }

        // Ambil semua lowongan pekerjaan yang terkait dengan perusahaan yang sedang login
        // Urutkan berdasarkan tanggal terbaru
        $jobs = Job::where('company_id', $company->id)->latest()->get();

        // Teruskan data lowongan pekerjaan dan objek perusahaan ke view
        // Menggunakan nama view yang Anda sebutkan: 'daCompany'
        return view('Company.daCompany', compact('company', 'jobs'));
    }

    // Metode lain di DashboardCompanyController Anda (jika ada)
}
