<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Applicant;
use App\Models\Company;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (!Auth::user() || !Auth::user()->hasRole('super_admin')) {
            abort(403, 'Unauthorized access');
        }
        
        // Ambil data untuk ditampilkan di dashboard
        $totalUsers = User::count();
        $totalApplicants = User::where('role', 'applicant')->count();
        $totalCompanies = User::where('role', 'company')->count();
        
        // Data tambahan yang mungkin dibutuhkan
        $recentUsers = User::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalApplicants', 
            'totalCompanies',
            'recentUsers'
        ));
    }
}