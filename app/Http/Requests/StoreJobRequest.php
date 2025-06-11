<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth; // Jika Anda perlu otorisasi berdasarkan user

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Hanya user dengan role 'company' yang bisa membuat lowongan
        return Auth::check() && Auth::user()->type === 'company'; // Sesuaikan dengan logika role/tipe user Anda
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type_of_work' => 'required|string|in:Full-Time,Part-Time,Remote,Freelance,Internship',
            'location' => 'required|string|max:255',
            'gaji_min' => 'nullable|integer|min:0',
            'gaji_max' => 'nullable|integer|min:0|gte:gaji_min', // max harus lebih besar atau sama dengan min
            // Tambahkan validasi untuk kolom lain di sini
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Judul pekerjaan wajib diisi.',
            'description.required' => 'Deskripsi pekerjaan wajib diisi.',
            'type_of_work.required' => 'Tipe pekerjaan wajib diisi.',
            'type_of_work.in' => 'Tipe pekerjaan yang dipilih tidak valid.',
            'location.required' => 'Lokasi pekerjaan wajib diisi.',
            'gaji_min.integer' => 'Gaji minimum harus angka.',
            'gaji_max.integer' => 'Gaji maksimum harus angka.',
            'gaji_max.gte' => 'Gaji maksimum harus lebih besar atau sama dengan gaji minimum.',
        ];
    }
}
