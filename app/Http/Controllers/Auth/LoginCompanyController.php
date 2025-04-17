<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginCompanyController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.company.login');  // Pastikan Anda memiliki file auth/login.blade.php
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Logika untuk login
    }
}
