<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RegisterCompanyController extends Controller
{
    /**
     * Menampilkan formulir registrasi
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('Auth.registerCompany');
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
                'name.max' => 'Username maksimal 255 karakter.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar, gunakan email lain atau login.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'company_name.required' => 'Nama perusahaan wajib diisi.',
                'company_name.max' => 'Nama perusahaan maksimal 255 karakter.',
                'company_address.required' => 'Alamat perusahaan wajib diisi.',
                'website_address.required' => 'Website perusahaan wajib diisi.',
                'website_address.url' => 'Format website tidak valid (gunakan http:// atau https://).',
                'company_email.required' => 'Email perusahaan wajib diisi.',
                'company_email.email' => 'Format email perusahaan tidak valid.',
                'company_email.different' => 'Email perusahaan harus berbeda dengan email akun.',
                'company_phone_number.required' => 'Nomor telepon perusahaan wajib diisi.',
                'logo.image' => 'File logo harus berupa gambar.',
                'logo.mimes' => 'Logo harus berformat JPG, PNG, JPEG, atau GIF.',
                'logo.max' => 'Ukuran logo maksimal 2MB.',
                'position.required' => 'Posisi pekerjaan wajib diisi.',
                'type_of_work.required' => 'Tipe pekerjaan wajib diisi.',
                'location.required' => 'Lokasi kerja wajib diisi.',
                'salary_min.required' => 'Gaji minimum wajib diisi.',
                'salary_min.numeric' => 'Gaji minimum harus berupa angka.',
                'salary_max.required' => 'Gaji maksimum wajib diisi.',
                'salary_max.numeric' => 'Gaji maksimum harus berupa angka.',
                'salary_max.gte' => 'Gaji maksimum tidak boleh lebih kecil dari gaji minimum.',
                'deadline.required' => 'Deadline lamaran wajib diisi.',
                'deadline.date' => 'Format tanggal deadline tidak valid.',
                'deadline.after' => 'Deadline harus setelah hari ini.',
                'job_description.required' => 'Deskripsi pekerjaan wajib diisi.',
                'job_description.min' => 'Deskripsi pekerjaan minimal 50 karakter.',
            ];

            // Validasi data dari formulir
            $validated = $request->validate([
                // User data validation
                'name' => 'required|string|max:255|unique:users,name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|in:applicant,company',
                
                // Company data validation
                'company_name' => 'required|string|max:255',
                'company_address' => 'required|string|min:10',
                'website_address' => 'required|url',
                'company_email' => 'required|email|different:email',
                'company_phone_number' => 'required|string|min:10|max:15',
                'logo' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
                
                // Job vacancy validation
                'position' => 'required|string|max:100',
                'type_of_work' => 'required|string|max:50',
                'location' => 'required|string|max:100',
                'salary_min' => 'required|numeric|min:1000000',
                'salary_max' => 'required|numeric|min:1000000|gte:salary_min',
                'deadline' => 'required|date|after:today',
                'job_description' => 'required|string|min:50|max:2000',
            ], $messages);

            // Additional custom validations
            $this->performAdditionalValidations($request);

            // Start database transaction
            DB::beginTransaction();

            // Menyiapkan data untuk pengguna baru
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ];

            // Menyimpan pengguna baru di tabel 'users'
            $user = User::create($userData);

            // Menyimpan data perusahaan jika role adalah 'company'
            if ($request->role === 'company') {
                // Handle logo upload
                $logoPath = null;
                if ($request->hasFile('logo')) {
                    $logoPath = $this->handleLogoUpload($request->file('logo'));
                }
                
                // Buat data company
                $companyData = [
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
                ];

                Company::create($companyData);
            }

            // Commit transaction
            DB::commit();

            // Success notification
            return redirect()->route('login.company')->with([
                'success' => 'Selamat! Registrasi perusahaan berhasil.',
                'message' => 'Akun perusahaan Anda telah dibuat. Silakan login untuk mulai merekrut talent terbaik.',
                'company_name' => $request->company_name
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
            Log::error('Company Registration Error: ' . $e->getMessage());

            // Delete uploaded logo if it exists
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

        // Validate phone number format (Indonesian)
        if ($request->company_phone_number) {
            if (!preg_match('/^(\+62|62|0)[0-9]{9,13}$/', $request->company_phone_number)) {
                $errors['company_phone_number'] = 'Format nomor telepon tidak valid. Gunakan format Indonesia (08xx, 62xx, atau +62xx).';
            }
        }

        // Validate website URL more strictly
        if ($request->website_address) {
            if (!filter_var($request->website_address, FILTER_VALIDATE_URL)) {
                $errors['website_address'] = 'Format website tidak valid. Pastikan menggunakan http:// atau https://.';
            }
        }

        // Validate salary range is reasonable
        if ($request->salary_min && $request->salary_max) {
            if ($request->salary_max < $request->salary_min) {
                $errors['salary_max'] = 'Gaji maksimum tidak boleh lebih kecil dari gaji minimum.';
            }
            
            // Check if salary difference is reasonable (not more than 10x)
            if ($request->salary_max > ($request->salary_min * 10)) {
                $errors['salary_max'] = 'Rentang gaji terlalu besar. Periksa kembali nilai gaji yang dimasukkan.';
            }
        }

        // Validate deadline is not too far in future (max 1 year)
        if ($request->deadline) {
            $deadlineDate = \Carbon\Carbon::parse($request->deadline);
            $maxDate = \Carbon\Carbon::now()->addYear();
            if ($deadlineDate->gt($maxDate)) {
                $errors['deadline'] = 'Deadline maksimal 1 tahun dari sekarang.';
            }
        }

        // Check if company name is not too generic
        $genericNames = ['company', 'perusahaan', 'pt', 'cv', 'ltd', 'inc'];
        if ($request->company_name) {
            $companyNameLower = strtolower($request->company_name);
            if (in_array($companyNameLower, $genericNames) || strlen($companyNameLower) < 3) {
                $errors['company_name'] = 'Nama perusahaan harus spesifik dan minimal 3 karakter.';
            }
        }

        if (!empty($errors)) {
            throw ValidationException::withMessages($errors);
        }
    }

    /**
     * Handle logo upload with proper error handling
     */
    private function handleLogoUpload($logoFile)
    {
        try {
            // Validate file
            if (!$logoFile->isValid()) {
                throw new \Exception('File logo tidak valid atau rusak.');
            }

            // Check file size (2MB)
            if ($logoFile->getSize() > 2 * 1024 * 1024) {
                throw new \Exception('Ukuran logo maksimal 2MB.');
            }

            // Check file type
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!in_array($logoFile->getMimeType(), $allowedTypes)) {
                throw new \Exception('Format logo harus JPG, PNG, JPEG, atau GIF.');
            }

            // Generate unique filename
            $filename = 'logo_' . time() . '_' . uniqid() . '.' . $logoFile->getClientOriginalExtension();
            
            // Store file
            return $logoFile->storeAs('logos', $filename, 'public');

        } catch (\Exception $e) {
            throw new \Exception('Gagal mengupload logo: ' . $e->getMessage());
        }
    }

    /**
     * Clean up files if registration fails
     */
    private function cleanupFailedUpload(Request $request)
    {
        if ($request->hasFile('logo')) {
            try {
                // Files are automatically cleaned up by PHP, but we can add custom cleanup if needed
            } catch (\Exception $e) {
                // Ignore cleanup errors
            }
        }
    }

    /**
     * Validate company uniqueness (optional - for future use)
     */
    private function validateCompanyUniqueness(Request $request)
    {
        // Check if company with same name and email already exists
        $existingCompany = Company::where('company_name', $request->company_name)
                                 ->where('company_email', $request->company_email)
                                 ->first();

        if ($existingCompany) {
            throw ValidationException::withMessages([
                'company_name' => 'Perusahaan dengan nama dan email ini sudah terdaftar.',
                'company_email' => 'Email perusahaan ini sudah digunakan.'
            ]);
        }
    }
}