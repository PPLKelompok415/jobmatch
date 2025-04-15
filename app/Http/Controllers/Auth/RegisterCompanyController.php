<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterCompanyController extends Controller
{
    /**
     * Menampilkan formulir registrasi
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.registerCompany');  // Menampilkan view formulir pendaftaran
    }

    /**
     * Menangani pengiriman formulir registrasi
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasi data dari formulir
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:applicant,company',
        ]);

        // Menyiapkan data untuk pengguna baru
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ];

        try {
            // Menyimpan pengguna baru di tabel 'userData'
            $user = User::create($userData);

        // Menyimpan data perusahaan jika role adalah 'company'
        if ($request->role === 'company') {
            // Simpan file logo jika ada
            $logoPath = $request->hasFile('logo') ? $request->file('logo')->store('logos', 'public') : null;
            
            // Buat data company
            Company::create([
                'user_id' => $user->id,
                'logo' => $logoPath,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'website_address' => $request->website_address,
                'company_email' => $request->company_email,
                'company_phone_number' => $request->company_phone_number,
                'position' => $request->position,
                'type_of_work' => $request->type_of_work,
                'location' => $request->location,
                'salary_min' => $request->salary_min,
                'salary_max' => $request->salary_max,
                'deadline' => $request->deadline,
                'job_description' => $request->job_description,
            ]);
            }

            // Menambahkan pesan flash ke session untuk menandakan berhasil
            session()->flash('success', 'Registrasi berhasil! Silakan login.');

            // Redirect ke halaman login setelah registrasi berhasil
            return redirect()->route('auth.loginApplicant');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat registrasi: ' . $e->getMessage());
            return back()->withInput($request->except('password', 'password_confirmation'));
        }
    }
}
