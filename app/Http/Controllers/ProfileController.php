<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Applicant; // Pastikan ini sudah benar
use App\Models\User;     // Pastikan ini juga di-import untuk update email/nama user

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login')->with('error', 'Anda perlu login untuk melihat profil.');
        }

        $applicant = $user->applicant;

        if (!$applicant) {
            // Inisialisasi objek Applicant baru untuk menghindari error jika belum ada
            // Berikan nilai default untuk kolom-kolom yang NOT NULL jika Applicant baru dibuat
            $applicant = new Applicant([
                'user_id' => $user->id, // Penting untuk mengaitkan dengan user
                'name' => $user->name ?? '', // Ambil dari user jika ada
                'email' => $user->email ?? '', // Ambil dari user
                'full_name' => $user->name ?? '', // Inisialisasi nama lengkap dari nama user
                'address' => '',
                'phone_number' => '',
                'date_of_birth' => null, 
                'gender' => '',
                'institution' => '',
                'major' => '',
                'graduation_year' => null, 
                'soft_skills' => '',
                'hard_skills' => '',
                'desired_position' => '', 
                // Kolom-kolom dari applicants.json
                'work_company' => '',     // <-- Inisialisasi
                'work_position' => '',    // <-- Inisialisasi
                'work_description' => '', // <-- Inisialisasi
                'certification' => null,  // <-- Inisialisasi (path file, bisa null)
                'type_of_work' => '',     // <-- Inisialisasi
                'location' => '',         // <-- Inisialisasi
                'salary_min' => 0,        // <-- Inisialisasi (int)
                'salary_max' => 0,        // <-- Inisialisasi (int)
                'availability_date' => null, // <-- Inisialisasi (date)
                'cv_file' => null,
                'portfolio_file' => null,
                'photo' => null,
            ]);
            // Jangan save di sini karena ini hanya untuk tampilan. Akan di-save saat update.
        }

        return view('profile.profile', compact('applicant', 'user')); // Pastikan 'user' juga di-compact
    }

    /**
     * Handle the profile update request.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login')->with('error', 'Anda perlu login untuk memperbarui profil.');
        }

        // Ambil data applicant atau buat instance baru jika belum ada
        $applicant = $user->applicant;
        if (!$applicant) {
            $applicant = new Applicant(['user_id' => $user->id]);
        }

        // 1. Validasi Data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female,other',
            'institution' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'soft_skills' => 'required|string',
            'hard_skills' => 'required|string',
            'desired_position' => 'required|string|max:255', 

            'work_company' => 'required|string|max:255',
            'work_position' => 'required|string|max:255',
            'work_description' => 'required|string',
            'certification' => 'nullable|file|mimes:pdf|max:2048',
            'type_of_work' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary_min' => 'required|integer|min:0',
            'salary_max' => 'required|integer|min:0|gt:salary_min',
            'availability_date' => 'required|date',

            // Aturan validasi untuk file harus ada, tetapi nilainya akan diisi secara manual
            // di `$validatedData` setelah proses `store()`.
            'cv_file' => 'nullable|file|mimes:pdf|max:2048',
            'portfolio_file' => 'nullable|file|mimes:pdf,zip,rar|max:5120',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update email di tabel users jika berubah
        if ($user->email !== $validatedData['email']) {
            $user->email = $validatedData['email'];
            $user->save();
        }

        // --- Handle File Uploads dan simpan path ke $validatedData ---
        // PENTING: Lakukan ini *sebelum* $applicant->fill($validatedData)
        // Photo Profile
        if ($request->hasFile('photo')) {
            if ($applicant->photo && Storage::disk('public')->exists($applicant->photo)) {
                Storage::disk('public')->delete($applicant->photo);
            }
            // Simpan path permanen ke $validatedData
            $validatedData['photo'] = $request->file('photo')->store('applicants/photos', 'public');
        } else {
            // Jika tidak ada upload baru, pertahankan foto lama jika ada
            $validatedData['photo'] = $applicant->photo;
        }

        // CV File
        if ($request->hasFile('cv_file')) {
            if ($applicant->cv_file && Storage::disk('public')->exists($applicant->cv_file)) {
                Storage::disk('public')->delete($applicant->cv_file);
            }
            // Simpan path permanen ke $validatedData
            $validatedData['cv_file'] = $request->file('cv_file')->store('applicants/cvs', 'public');
        } else {
            $validatedData['cv_file'] = $applicant->cv_file;
        }

        // Portfolio File
        if ($request->hasFile('portfolio_file')) {
            if ($applicant->portfolio_file && Storage::disk('public')->exists($applicant->portfolio_file)) {
                Storage::disk('public')->delete($applicant->portfolio_file);
            }
            // Simpan path permanen ke $validatedData
            $validatedData['portfolio_file'] = $request->file('portfolio_file')->store('applicants/portfolios', 'public');
        } else {
            $validatedData['portfolio_file'] = $applicant->portfolio_file;
        }

        // Certification File
        if ($request->hasFile('certification')) {
            if ($applicant->certification && Storage::disk('public')->exists($applicant->certification)) {
                Storage::disk('public')->delete($applicant->certification);
            }
            // Simpan path permanen ke $validatedData
            $validatedData['certification'] = $request->file('certification')->store('applicants/certifications', 'public');
        } else {
            $validatedData['certification'] = $applicant->certification;
        }
        // --- Akhir Handle File Uploads ---

        // Isi data applicant dari $validatedData yang kini sudah berisi path file permanen
        $applicant->fill($validatedData);
        
        // Simpan data applicant
        $applicant->save();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }
}
