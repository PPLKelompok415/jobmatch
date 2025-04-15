<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Menampilkan formulir registrasi
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Menangani pengiriman formulir registrasi
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // HAPUS dd() agar kode dapat berjalan
        // dd($request->all());
        
        // Validasi data dari formulir
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:applicant,company',
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female,other',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
            'cv_file' => 'required|mimes:pdf,doc,docx|max:2048',
            'portfolio_file' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        // Menyiapkan data untuk pengguna baru
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ];

        try {
            // Menyimpan pengguna baru di tabel 'users'
            $user = User::create($data);

            // Menyimpan data applicant jika role adalah 'applicant'
            if ($request->role === 'applicant') {
                // Simpan file yang diunggah
                $photoPath = $request->file('photo')->store('photos', 'public');
                $cvPath = $request->file('cv_file')->store('cvs', 'public');
                $portfolioPath = $request->hasFile('portfolio_file') ? $request->file('portfolio_file')->store('portfolios', 'public') : null;
                $certificationPath = $request->hasFile('certification') ? $request->file('certification')->store('certifications', 'public') : null;
                
                // Buat data applicant
                $applicantData = [
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'full_name' => $request->full_name,
                    'photo' => $photoPath,
                    'cv_file' => $cvPath,
                    'portfolio_file' => $portfolioPath,
                    'date_of_birth' => $request->date_of_birth,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'desired_position' => $request->desired_position,
                    'type_of_work' => $request->type_of_work,
                    'location' => $request->location,
                    'salary_min' => $request->salary_min,
                    'salary_max' => $request->salary_max,
                    'availability_date' => $request->availability_date,
                    'institution' => $request->institution,
                    'major' => $request->major,
                    'graduation_year' => $request->graduation_year,
                    'work_company' => $request->work_company,
                    'work_position' => $request->work_position,
                    'work_description' => $request->work_description,
                    'soft_skills' => $request->soft_skills,
                    'hard_skills' => $request->hard_skills,
                    'certification' => $certificationPath,
                ];
                
                // Buat applicant terkait dengan user
                Applicant::create($applicantData);
            }

            // Menambahkan pesan flash ke session untuk menandakan berhasil
            session()->flash('success', 'Registrasi berhasil! Silakan login.');

            // Redirect ke halaman login setelah registrasi berhasil
            return redirect()->route('auth.loginApplicant');
            
        } catch (\Exception $e) {
            // Menambahkan pesan error jika terjadi kesalahan saat menyimpan
            session()->flash('error', 'Terjadi kesalahan saat registrasi: ' . $e->getMessage());
            return back()->withInput($request->except('password', 'password_confirmation'));
        }
    }
}