<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginApplicantController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        // Menggunakan 'auth.loginApplicant' sesuai konvensi Laravel (folder lowercase)
        return view('auth.loginApplicant');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi form login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6', // Panjang password minimal 6 karakter
        ]);

        // Cek kredensial login
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {
            
            $user = Auth::user();
            
            // Validasi role: hanya applicant yang boleh login melalui portal ini (dari cabang main)
            if ($user->role !== 'applicant') {
                Auth::logout(); // Logout user yang bukan applicant
                
                // Redirect ke login yang sesuai berdasarkan role
                if ($user->role === 'company') {
                    return redirect()->route('login.company')
                        ->with('error', 'Akun perusahaan tidak dapat menggunakan portal login pelamar. Silakan gunakan portal login perusahaan.');
                } elseif ($user->role === 'admin' || $user->role === 'super_admin') {
                    return redirect()->route('login.admin')
                        ->with('error', 'Akun admin tidak dapat menggunakan portal login pelamar. Silakan gunakan portal login admin.');
                } else {
                    return redirect()->back()
                        ->with('error', 'Tipe akun Anda tidak dapat menggunakan portal login pelamar.');
                }
            }
            
            // Jika role adalah applicant dan login berhasil, regenerate session dan redirect ke dashboard
            $request->session()->regenerate(); // Untuk keamanan session
            return redirect()->intended(route('applicant.dashboard'));
        }

        // Jika kredensial salah, kembali ke halaman login dengan pesan error
        return redirect()->back()
            ->withErrors(['email' => 'Email atau password yang Anda masukkan salah.'])
            ->withInput($request->except('password')); // Agar email tetap terisi
    }

    // Fungsi logout
    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        $request->session()->invalidate(); // Hapus session yang ada
        $request->session()->regenerateToken(); // Buat ulang token CSRF
        
        return redirect()->route('home') // Redirect ke halaman home
            ->with('success', 'Anda telah berhasil logout.'); // Tampilkan pesan sukses
    }
}