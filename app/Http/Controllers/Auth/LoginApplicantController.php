<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Tambahkan ini untuk autentikasi
use App\Http\Controllers\Controller;

class LoginApplicantController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.loginApplicant');  // Tampilkan halaman login
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi form login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cek kredensial login
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {
            // Jika login berhasil, arahkan ke dashboard applicant
            return redirect()->route('applicant.dashboard');
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    // Logout function
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');  // Redirect ke halaman home setelah logout
    }
}
