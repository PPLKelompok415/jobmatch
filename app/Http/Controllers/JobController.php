<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company; // Pastikan ini di-import
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage; // Perbaikan: Mengubah '->' menjadi '\'
use Illuminate\Support\Facades\Auth; // Perbaikan: Mengubah '->' menjadi '\'

class JobController extends Controller
{
    /**
     * Metode index() ini menampilkan daftar lowongan pekerjaan.
     * Dapat memfilter berdasarkan ID perusahaan yang diberikan melalui query string 'id'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Job::with('company'); // Selalu muat relasi 'company'

        $companyId = null; 
        
        // Cek parameter 'id' terlebih dahulu (seperti yang dikirim dari link navbar)
        if ($request->has('id') && is_numeric($request->id)) {
            $companyId = (int) $request->id;
        } 
        // Jika 'id' tidak ada, cek parameter 'company_id' (untuk konsistensi jika ada sumber lain)
        elseif ($request->has('company_id') && is_numeric($request->company_id)) {
            $companyId = (int) $request->company_id;
        }

        // Terapkan filter perusahaan jika companyId ditemukan
        if ($companyId) {
            $query->where('company_id', $companyId);
        }

        // Filter lain yang Anda miliki
        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        if ($request->has('min_gaji') && is_numeric($request->min_gaji)) {
            $query->where('gaji_max', '>=', (int) $request->min_gaji);
        }
        if ($request->has('type') && !empty($request->type)) {
            $query->where('type_of_work', 'like', '%' . $request->type . '%'); // Mengubah ke like untuk fleksibilitas
        }
        if ($request->has('bidang') && !empty($request->bidang)) {
            $query->where('bidang', 'like', '%' . $request->bidang . '%'); // Mengubah ke like untuk fleksibilitas
        }

        $jobs = $query->latest()->get(); 
        
        return view('jobs.index', compact('jobs')); // Menggunakan 'jobs.index'
    }

    /**
     * Display the community page with all job listings.
     * This method is specifically for the 'Community' link in the navbar.
     *
     * @return \Illuminate\View\View
     */
    public function showCommunityJobs()
    {
        // Fetch all jobs, as the community page should show all public listings
        $jobs = Job::with('company')->latest()->get();
        return view('community', compact('jobs'));
    }

    /**
     * Display the form for creating a new job.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $companies = Company::all(); // Get all companies for the dropdown
        return view('jobs.create', compact('companies')); // Menggunakan view 'jobs.create'
    }

    /**
     * Store a newly created job in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'location' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'type_of_work' => 'required|string|max:255',
            'gaji_min' => 'nullable|numeric|min:0',
            'gaji_max' => 'nullable|numeric|min:0|gte:gaji_min',
        ]);

        Job::create($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Lowongan pekerjaan berhasil ditambahkan!');
    }

    /**
     * Display the specified job for editing.
     * Uses Route Model Binding to find the Job by ID.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\View\View
     */
    public function edit(Job $job) 
    {
        $companies = Company::all(); // Get all companies for the dropdown
        return view('jobs.edit', compact('job', 'companies')); // Menggunakan view 'jobs.edit'
    }

    /**
     * Update the specified job in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Job $job)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id', 
            'location' => 'required|string|max:255',
            'bidang' => 'required|string|max:255', 
            'type_of_work' => 'required|string|max:255',
            'gaji_min' => 'nullable|numeric|min:0',
            'gaji_max' => 'nullable|numeric|min:0|gte:gaji_min',
        ]);

        $job->update($validatedData); 

        return redirect()->route('jobs.index')->with('success', 'Lowongan pekerjaan berhasil diperbarui!');
    }

    /**
     * Remove the specified job from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Job $job) 
    {
        $job->delete(); 

        return redirect()->route('jobs.index')->with('success', 'Lowongan pekerjaan berhasil dihapus!');
    }



    ### **Metode untuk Mengelola Data Perusahaan**

  


    /**
     * Display the specified company's details.
     * Uses Route Model Binding to find the Company by ID.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\View\View
     */
    public function showCompany(Company $company)
    {
        return view('jobs.show_company', compact('company')); 
    }

    /**
     * Display the form for editing the specified company.
     * Uses Route Model Binding to find the Company by ID.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\View\View
     */
    public function editCompany(Company $company)
    {
        return view('jobs.edit', compact('company')); 
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
        $userId = Auth::id(); 

        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'website_address' => 'required|string|max:255',
            'company_email' => 'required|email|max:255|unique:companies,company_email,' . $company->id,
            'company_phone_number' => 'required|string|max:255',
            'position' => 'required|string|max:255', 
            'type_of_work' => 'required|string|max:255', 
            'location' => 'required|string|max:255', 
            'salary_min' => 'required|integer|min:0', 
            'salary_max' => 'required|integer|min:0|gte:salary_min', 
            'deadline' => 'required|date', 
            'job_description' => 'required|string', 
        ]);

        $validatedData['user_id'] = $userId; 

        if ($request->hasFile('logo')) {
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
            $validatedData['logo'] = $request->file('logo')->store('companies/logos', 'public');
        } else {
            $validatedData['logo'] = $company->logo;
        }

        $company->update($validatedData);

        return redirect()->route('companies.show', $company->id)->with('success', 'Data perusahaan berhasil diperbarui!');
    }

    /**
     * Remove the specified company from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyCompany(Company $company)
    {
        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        return redirect()->route('home')->with('success', 'Perusahaan berhasil dihapus!');
    }
}
