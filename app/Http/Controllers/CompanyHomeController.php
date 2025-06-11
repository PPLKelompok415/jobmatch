<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyHomeController extends Controller
{
    public function index()
    {
        return view('CompanyHome'); // Halaman home company
    }

    public function createJob()
    {
        return view('Company.createjob'); // Form untuk posting job
    }

    public function storeJob(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type_of_work' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'gaji_min' => 'required|integer',
            'gaji_max' => 'required|integer',
            'bidang' => 'required|string|max:255',
        ]);

        Job::create([
            'company_id' => Auth::id(), // pastikan user login adalah company
            'title' => $request->title,
            'type_of_work' => $request->type_of_work,
            'location' => $request->location,
            'gaji_min' => $request->gaji_min,
            'gaji_max' => $request->gaji_max,
            'bidang' => $request->bidang,
        ]);

        return redirect()->route('company.dashboard')->with('success', 'Lowongan berhasil diposting.');
    }
}

