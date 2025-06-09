<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Pastikan ini di-import jika Anda menggunakan soft deletes
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import untuk relasi BelongsTo

class Applicant extends Model
{
    use HasFactory, SoftDeletes; // Tambahkan SoftDeletes jika Anda menggunakannya

    protected $fillable = [
        'user_id',
        'name',
        'full_name',
        'email',
        'address',
        'phone_number',
        'date_of_birth',
        'gender',
        'institution',
        'major',
        'graduation_year',
        'soft_skills',
        'hard_skills',
        'cv_file',
        'portfolio_file',
        'photo',
        'desired_position', // <-- Ditambahkan Kembali
        'work_company',
        'work_position',
        'work_description',
        'certification',
        'type_of_work',
        'location',
        'salary_min',
        'salary_max',
        'availability_date',
    ];

    protected $casts = [
        'soft_skills' => 'string',    // Menggunakan 'string' karena JSON di contoh Anda terlihat seperti string yang perlu di-parse manual
        'hard_skills' => 'string',    // Menggunakan 'string' karena JSON di contoh Anda terlihat seperti string yang perlu di-parse manual
        'date_of_birth' => 'date',   // Cast ke Carbon instance
        'availability_date' => 'date', // Cast ke Carbon instance
        'salary_min' => 'integer',   // Cast ke integer
        'salary_max' => 'integer',   // Cast ke integer
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
