<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Menampilkan formulir registrasi
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('Auth.register');
    }

    /**
     * Menangani pengiriman formulir registrasi
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        try {
            // Custom validation messages
            $messages = [
                'name.required' => 'Username wajib diisi.',
                'name.unique' => 'Username sudah digunakan, silakan pilih username lain.',
                'name.max' => 'Username maksimal 50 karakter.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar, gunakan email lain atau login.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'full_name.required' => 'Nama lengkap wajib diisi.',
                'full_name.max' => 'Nama lengkap maksimal 255 karakter.',
                'date_of_birth.required' => 'Tanggal lahir wajib diisi.',
                'date_of_birth.date' => 'Format tanggal lahir tidak valid.',
                'gender.required' => 'Jenis kelamin wajib dipilih.',
                'gender.in' => 'Jenis kelamin harus male, female, atau other.',
                'phone_number.required' => 'Nomor telepon wajib diisi.',
                'address.required' => 'Alamat wajib diisi.',
                'photo.required' => 'Photo profil wajib diupload.',
                'photo.image' => 'File photo harus berupa gambar.',
                'photo.mimes' => 'Photo harus berformat JPG, PNG, JPEG, atau GIF.',
                'photo.max' => 'Ukuran photo maksimal 2MB.',
                'cv_file.required' => 'File CV wajib diupload.',
                'cv_file.mimes' => 'CV harus berformat PDF, DOC, atau DOCX.',
                'cv_file.max' => 'Ukuran CV maksimal 2MB.',
                'portfolio_file.mimes' => 'Portfolio harus berformat PDF, DOC, DOCX, atau ZIP.',
                'portfolio_file.max' => 'Ukuran portfolio maksimal 5MB.',
                'desired_position.required' => 'Posisi pekerjaan yang diinginkan wajib diisi.',
                'type_of_work.required' => 'Tipe pekerjaan wajib diisi.',
                'location.required' => 'Lokasi kerja wajib diisi.',
                'salary_min.required' => 'Gaji minimum wajib diisi.',
                'salary_min.numeric' => 'Gaji minimum harus berupa angka.',
                'salary_max.required' => 'Gaji maksimum wajib diisi.',
                'salary_max.numeric' => 'Gaji maksimum harus berupa angka.',
                'availability_date.required' => 'Tanggal ketersediaan wajib diisi.',
                'availability_date.date' => 'Format tanggal ketersediaan tidak valid.',
            ];

            // Validasi data dari formulir
            $validated = $request->validate([
                'name' => 'required|string|max:50|unique:users,name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|in:applicant,company',
                'full_name' => 'required|string|max:255',
                'date_of_birth' => 'required|date|before:today',
                'gender' => 'required|string|in:male,female,other',
                'phone_number' => 'required|string|min:10|max:15',
                'address' => 'required|string|min:10',
                'photo' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
                'cv_file' => 'required|mimes:pdf,doc,docx|max:2048',
                'portfolio_file' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
                'desired_position' => 'required|string|max:100',
                'type_of_work' => 'required|string|max:50',
                'location' => 'required|string|max:100',
                'salary_min' => 'required|numeric|min:0',
                'salary_max' => 'required|numeric|min:0|gte:salary_min',
                'availability_date' => 'required|date|after_or_equal:today',
                // Optional fields
                'institution' => 'nullable|string|max:255',
                'major' => 'nullable|string|max:255',
                'graduation_year' => 'nullable|integer|min:1900|max:2030',
                'work_company' => 'nullable|string|max:255',
                'work_position' => 'nullable|string|max:255',
                'work_description' => 'nullable|string|max:1000',
                'soft_skills' => 'nullable|string|max:500',
                'hard_skills' => 'nullable|string|max:500',
                'certification' => 'nullable|mimes:pdf,doc,docx,jpg,png,jpeg|max:2048',
            ], $messages);

            // Additional custom validations
            $this->performAdditionalValidations($request);

            // Menyiapkan data untuk pengguna baru
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ];

            // Start database transaction
            DB::beginTransaction();

            // Menyimpan pengguna baru di tabel 'users'
            $user = User::create($userData);

            // Menyimpan data applicant jika role adalah 'applicant'
            if ($request->role === 'applicant') {
                // Simpan files dengan error handling
                $filePaths = $this->handleFileUploads($request);

                // Buat data applicant
                $applicantData = [
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'full_name' => $request->full_name,
                    'photo' => $filePaths['photo'],
                    'cv_file' => $filePaths['cv_file'],
                    'portfolio_file' => $filePaths['portfolio_file'],
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
                    'certification' => $filePaths['certification'],
                ];

                // Buat applicant terkait dengan user
                Applicant::create($applicantData);
            }

            // Commit transaction
            DB::commit();

            // Success notification
            return redirect()->route('login.applicant')->with([
                'success' => 'Selamat! Registrasi berhasil.',
                'message' => 'Akun Anda telah dibuat. Silakan login untuk melanjutkan.',
                'user_name' => $request->full_name
            ]);

        } catch (ValidationException $e) {
            // Validation errors - akan otomatis di-handle oleh Laravel
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput($request->except(['password', 'password_confirmation']))
                ->with('error', 'Periksa kembali data yang Anda masukkan.');

        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollback();

            // Log the actual error for debugging
            Log::error('Registration Error: ' . $e->getMessage());

            // Delete uploaded files if they exist
            $this->cleanupFailedUpload($request);

            // Generic error message for user
            return redirect()->back()
                ->withInput($request->except(['password', 'password_confirmation']))
                ->with([
                    'error' => 'Registrasi gagal. Silakan coba lagi.',
                    'details' => 'Terjadi kesalahan sistem. Jika masalah berlanjut, hubungi support.'
                ]);
        }
    }

    /**
     * Perform additional custom validations
     */
    private function performAdditionalValidations(Request $request)
    {
        $errors = [];

        // Check age validation (minimum 17 years old)
        if ($request->date_of_birth) {
            $age = \Carbon\Carbon::parse($request->date_of_birth)->age;
            if ($age < 17) {
                $errors['date_of_birth'] = 'Usia minimal 17 tahun untuk mendaftar.';
            }
        }

        // Validate salary range
        if ($request->salary_min && $request->salary_max) {
            if ($request->salary_max < $request->salary_min) {
                $errors['salary_max'] = 'Gaji maksimum tidak boleh lebih kecil dari gaji minimum.';
            }
            if ($request->salary_min < 1000000) {
                $errors['salary_min'] = 'Gaji minimum sebaiknya minimal Rp 1.000.000.';
            }
        }

        // Validate phone number format (Indonesian)
        if ($request->phone_number) {
            if (!preg_match('/^(\+62|62|0)[0-9]{9,13}$/', $request->phone_number)) {
                $errors['phone_number'] = 'Format nomor telepon tidak valid. Gunakan format Indonesia (08xx, 62xx, atau +62xx).';
            }
        }

        // Validate availability date (not too far in future)
        if ($request->availability_date) {
            $availabilityDate = \Carbon\Carbon::parse($request->availability_date);
            $maxDate = \Carbon\Carbon::now()->addMonths(6);
            if ($availabilityDate->gt($maxDate)) {
                $errors['availability_date'] = 'Tanggal ketersediaan maksimal 6 bulan dari sekarang.';
            }
        }

        if (!empty($errors)) {
            throw ValidationException::withMessages($errors);
        }
    }

    /**
     * Handle file uploads with proper error handling
     */
    private function handleFileUploads(Request $request)
    {
        $filePaths = [
            'photo' => null,
            'cv_file' => null,
            'portfolio_file' => null,
            'certification' => null,
        ];

        try {
            // Upload photo
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoName = 'photo_' . time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                $filePaths['photo'] = $photo->storeAs('photos', $photoName, 'public');
            }

            // Upload CV
            if ($request->hasFile('cv_file')) {
                $cv = $request->file('cv_file');
                $cvName = 'cv_' . time() . '_' . uniqid() . '.' . $cv->getClientOriginalExtension();
                $filePaths['cv_file'] = $cv->storeAs('cvs', $cvName, 'public');
            }

            // Upload portfolio (optional)
            if ($request->hasFile('portfolio_file')) {
                $portfolio = $request->file('portfolio_file');
                $portfolioName = 'portfolio_' . time() . '_' . uniqid() . '.' . $portfolio->getClientOriginalExtension();
                $filePaths['portfolio_file'] = $portfolio->storeAs('portfolios', $portfolioName, 'public');
            }

            // Upload certification (optional)
            if ($request->hasFile('certification')) {
                $cert = $request->file('certification');
                $certName = 'cert_' . time() . '_' . uniqid() . '.' . $cert->getClientOriginalExtension();
                $filePaths['certification'] = $cert->storeAs('certifications', $certName, 'public');
            }

        } catch (\Exception $e) {
            // Clean up any uploaded files if there's an error
            foreach ($filePaths as $path) {
                if ($path && Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
            throw new \Exception('Gagal mengupload file. Periksa format dan ukuran file Anda.');
        }

        return $filePaths;
    }

    /**
     * Clean up files if registration fails
     */
    private function cleanupFailedUpload(Request $request)
    {
        $fileFields = ['photo', 'cv_file', 'portfolio_file', 'certification'];
        
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                try {
                    $file = $request->file($field);
                    // Files are automatically cleaned up by PHP, but we can add custom cleanup if needed
                } catch (\Exception $e) {
                    // Ignore cleanup errors
                }
            }
        }
    }
}
