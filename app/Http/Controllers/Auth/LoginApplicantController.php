<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginApplicantController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('Auth.loginApplicant');  // Pastikan Anda memiliki file auth/login.blade.php
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Logika untuk login
    }
}
