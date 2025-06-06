<?php

namespace App\Http\Controllers\Auth;

<<<<<<< HEAD
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Tambahkan ini untuk autentikasi
use App\Http\Controllers\Controller;
=======
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
>>>>>>> 444ce53668917cfcdb35b6f1d9804f9881ccbd6b

class LoginApplicantController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
<<<<<<< HEAD
        return view('auth.loginApplicant');  // Tampilkan halaman login
=======
        return view('Auth.loginApplicant');
>>>>>>> 444ce53668917cfcdb35b6f1d9804f9881ccbd6b
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
<<<<<<< HEAD
            // Jika login berhasil, arahkan ke dashboard applicant
            return redirect()->route('applicant.dashboard');
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
=======
            
            $user = Auth::user();
            
            // Validasi role - hanya applicant yang boleh login
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
            
            // Jika role adalah applicant, regenerate session dan redirect ke dashboard
            $request->session()->regenerate();
            return redirect()->intended(route('applicant.dashboard'));
        }

        // Jika kredensial salah
        return redirect()->back()
            ->withErrors(['email' => 'Email atau password yang Anda masukkan salah.'])
            ->withInput($request->except('password'));
>>>>>>> 444ce53668917cfcdb35b6f1d9804f9881ccbd6b
    }

    // Logout function
    public function logout(Request $request)
    {
        Auth::logout();
<<<<<<< HEAD
        return redirect('/');  // Redirect ke halaman home setelah logout
    }
}
=======
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home')
            ->with('success', 'Anda telah berhasil logout.');
    }
}
>>>>>>> 444ce53668917cfcdb35b6f1d9804f9881ccbd6b
