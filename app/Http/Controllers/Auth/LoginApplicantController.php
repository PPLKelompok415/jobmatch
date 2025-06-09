<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginApplicantController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm() // <--- METODE INI HARUS ADA DI SINI
    {
        return view('auth.loginApplicant');  // Tampilkan halaman login
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi form login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',  // Sesuaikan dengan panjang password yang dibutuhkan
        ]);

        // Kumpulkan kredensial
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Cek kredensial login
        $loggedIn = Auth::attempt($credentials, $request->remember);

        // --- HAPUS DD() INI SETELAH DEBUG ---
        // dd([
        //     'login_attempt_successful' => $loggedIn,
        //     'user_after_attempt' => Auth::user(),
        //     'intended_redirect' => redirect()->intended(route('applicant.dashboard'))->getTargetUrl(),
        // ]);
        // --- AKHIR DD() ---

        if ($loggedIn) {
            // Jika login berhasil, alihkan ke halaman dashboard applicant
            return redirect()->intended(route('applicant.dashboard'));
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