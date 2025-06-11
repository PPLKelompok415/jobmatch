<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class JobController extends Controller
{
    /**
     * Metode index() ini menampilkan daftar lowongan pekerjaan.
     * Dapat memfilter berdasarkan perusahaan jika instance Company diberikan melalui URL path
     * atau company_id diberikan melalui query string.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company|null  $companyFromPath  Opsional: Company from URL path (e.g., /jobs/company/12)
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request, Company $companyFromPath = null)
    {
        $currentCompany = $companyFromPath;

        if (!$currentCompany && $request->has('id')) {
            $companyIdFromQuery = $request->id;
            if (is_numeric($companyIdFromQuery)) {
                $currentCompany = Company::find($companyIdFromQuery);
                if (!$currentCompany) {
                    return redirect()->route('jobs.index')->with('error', 'Perusahaan dengan ID tersebut tidak ditemukan.');
                }
            } else if (!empty($companyIdFromQuery)) {
                return redirect()->route('jobs.index')->with('error', 'ID perusahaan tidak valid.');
            }
        }

        $query = Job::with('company');

        if ($currentCompany) {
            $query->where('company_id', $currentCompany->id);
        }

        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        if ($request->has('min_gaji') && is_numeric($request->min_gaji)) {
            $query->where('gaji_max', '>=', (int) $request->min_gaji);
        }
        if ($request->has('type') && !empty($request->type)) {
            $query->where('type_of_work', $request->type);
        }
        if ($request->has('bidang') && !empty($request->bidang)) {
            $query->where('bidang', 'like', '%' . $request->bidang . '%');
        }

        $jobs = $query->latest()->get();

        return view('jobs.index', compact('jobs', 'currentCompany'));
    }

    /**
     * Tampilkan halaman komunitas dengan semua daftar lowongan pekerjaan.
     * Metode ini khusus untuk tautan 'Komunitas' di navbar.
     *
     * @return \Illuminate\View\View
     */
    public function showCommunityJobs()
    {
        $jobs = Job::with('company')->latest()->get();
        return view('community', compact('jobs'));
    }

    /**
     * Tampilkan formulir untuk membuat lowongan pekerjaan baru.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        if (!Auth::check() || !Auth::user()->company) {
            return redirect()->route('Company.dashboard')->with('error', 'Anda harus melengkapi profil perusahaan untuk memposting lowongan.');
        }

        return view('jobs.create');
    }

    /**
     * Simpan lowongan pekerjaan yang baru dibuat di penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->company) {
            return redirect()->route('Company.dashboard')->with('error', 'Anda tidak memiliki izin untuk memposting lowongan.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => ['required', 'exists:companies,id', Rule::in([Auth::user()->company->id])],
            'location' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'type_of_work' => 'required|string|max:255',
            'gaji_min' => 'nullable|numeric|min:0',
            'gaji_max' => 'nullable|numeric|min:0|gte:gaji_min',
            'job_description' => 'required|string',
        ]);

        Job::create($validatedData);

        return redirect()->route('Company.dashboard')->with('success', 'Lowongan pekerjaan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail lowongan pekerjaan tertentu.
     * Menggunakan Route Model Binding untuk menemukan Pekerjaan berdasarkan ID.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(Job $job)
    {
        // Otorisasi: hanya perusahaan pemilik yang bisa melihat detail lowongan dari dashboard mereka
        // atau jika rute ini memang untuk publik
        if (Auth::check() && Auth::user()->company && Auth::user()->company->id !== $job->company_id) {
             return redirect()->route('Company.dashboard')->with('error', 'Anda tidak memiliki akses ke lowongan ini.');
        }
        
        return view('jobs.show', compact('job'));
    }

    /**
     * Tampilkan lowongan pekerjaan yang ditentukan untuk diedit.
     * Menggunakan Route Model Binding untuk menemukan Pekerjaan berdasarkan ID.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Job $job)
    {
        // Debugging: uncomment baris ini jika Anda masih mendapatkan error `$job` undefined
        // dd($job); 

        // Periksa apakah user yang login adalah pemilik lowongan ini
        if (!Auth::check() || !Auth::user()->company || Auth::user()->company->id !== $job->company_id) {
            return redirect()->route('Company.dashboard')->with('error', 'Anda tidak memiliki akses untuk mengedit lowongan ini.');
        }
        // Mengembalikan view jobs.edit dan mengirimkan variabel $job
        return view('jobs.edit', compact('job'));
    }

    /**
     * Perbarui lowongan pekerjaan yang ditentukan di penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Job $job)
    {
        if (!Auth::check() || !Auth::user()->company || Auth::user()->company->id !== $job->company_id) {
            return redirect()->route('Company.dashboard')->with('error', 'Anda tidak memiliki akses untuk memperbarui lowongan ini.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => ['required', 'exists:companies,id', Rule::in([Auth::user()->company->id])],
            'location' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'type_of_work' => 'required|string|max:255',
            'gaji_min' => 'nullable|numeric|min:0',
            'gaji_max' => 'nullable|numeric|min:0|gte:gaji_min',
            'job_description' => 'required|string',
        ]);

        $job->update($validatedData);

        return redirect()->route('Company.dashboard')->with('success', 'Lowongan pekerjaan berhasil diperbarui!');
    }

    /**
     * Hapus lowongan pekerjaan yang ditentukan dari penyimpanan.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Job $job)
    {
        if (!Auth::check() || !Auth::user()->company || Auth::user()->company->id !== $job->company_id) {
            return redirect()->route('Company.dashboard')->with('error', 'Anda tidak memiliki akses untuk menghapus lowongan ini.');
        }

        $job->delete();

        return redirect()->route('Company.dashboard')->with('success', 'Lowongan pekerjaan berhasil dihapus!');
    }

    // =====================================================================
    // METHODS FOR MANAGING COMPANY DATA
    // =====================================================================

    /**
     * Display the specified company's details.
     * Uses Route Model Binding to find the Company by ID.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showCompany(Company $company)
    {
        // Otorisasi: Hanya perusahaan yang login atau admin yang bisa melihat profilnya sendiri
        if (Auth::check() && Auth::user()->company && Auth::user()->company->id !== $company->id) {
            return redirect()->route('Company.dashboard')->with('error', 'Anda tidak memiliki akses ke profil perusahaan ini.');
        }
        
        // MENGUBAH show_company menjadi Company.show_company
        return view('Company.show_company', compact('company'));
    }

    /**
     * Display the form for editing the specified company.
     * Uses Route Model Binding to find the Company by ID.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function editCompany(Company $company)
    {
        // Debugging: uncomment baris ini jika Anda masih mendapatkan error `$company` undefined
        // dd($company); 

        // Otorisasi: Hanya perusahaan yang login yang bisa mengedit profilnya sendiri
        if (!Auth::check() || !Auth::user()->company || Auth::user()->company->id !== $company->id) {
            return redirect()->route('Company.dashboard')->with('error', 'Anda tidak memiliki akses untuk mengedit profil perusahaan ini.');
        }
        // MENGUBAH companies.edit menjadi Company.edit
        return view('Company.edit', compact('company'));
    }

    /**
     * Update the specified company in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCompany(Request $request, Company $company)
    {
        // Otorisasi: Hanya perusahaan yang login yang bisa memperbarui profilnya sendiri
        if (!Auth::check() || !Auth::user()->company || Auth::user()->company->id !== $company->id) {
            return redirect()->route('Company.dashboard')->with('error', 'Anda tidak memiliki izin untuk memperbarui profil perusahaan ini.');
        }

        // Validasi data untuk profil perusahaan.
        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|max:255|unique:companies,company_email,' . $company->id,
            'company_phone_number' => 'required|string|max:255',
            'company_address' => 'required|string|max:500',
            'website_address' => 'nullable|url|max:255',
            'description' => 'nullable|string', // Kolom deskripsi umum perusahaan
        ]);

        $validatedData['user_id'] = Auth::id();

        // Handle upload logo
        if ($request->hasFile('logo')) {
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
            $logoPath = $request->file('logo')->store('company_logos', 'public');
            $validatedData['logo'] = $logoPath;
        } else {
            unset($validatedData['logo']);
        }
        
        $company->update($validatedData);

        return redirect()->route('Company.dashboard')->with('success', 'Profil perusahaan berhasil diperbarui!');
    }

    /**
     * Remove the specified company from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyCompany(Company $company)
    {
        // Otorisasi: Hanya perusahaan yang login yang bisa menghapus profilnya sendiri
        if (!Auth::check() || !Auth::user()->company || Auth::user()->company->id !== $company->id) {
            return redirect()->route('Company.dashboard')->with('error', 'Anda tidak memiliki izin untuk menghapus profil perusahaan ini.');
        }

        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        return redirect()->route('Company.dashboard')->with('success', 'Perusahaan berhasil dihapus!');
    }
}
