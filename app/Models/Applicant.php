<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Diperlukan untuk fitur soft delete
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Diperlukan untuk relasi BelongsTo
use Illuminate\Database\Eloquent\Relations\HasMany; // Diperlukan untuk relasi HasMany
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Diperlukan untuk relasi BelongsToMany

class Applicant extends Model
{
    use HasFactory, SoftDeletes; // Menggunakan trait SoftDeletes

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
        'soft_skills',      // Jika ini kolom teks langsung
        'hard_skills',      // Jika ini kolom teks langsung
        'cv_file',
        'portfolio_file',
        'photo',
        'desired_position', 
        'work_company',
        'work_position',
        'work_description',
        'certification',    // Jika ini kolom teks langsung
        'type_of_work',
        'location',
        'salary_min',
        'salary_max',
        'availability_date',
        // Catatan: 'password' dan 'role' dihapus dari $fillable karena biasanya ada di model User
    ];

    protected $casts = [
        'date_of_birth' => 'date',      // Mengubah ke objek Carbon Date
        'availability_date' => 'date',  // Mengubah ke objek Carbon Date
        'salary_min' => 'integer',      // Mengubah ke integer
        'salary_max' => 'integer',      // Mengubah ke integer
        // 'soft_skills' dan 'hard_skills' tidak perlu di-cast ke 'string' karena sudah default.
        // Jika mereka dimaksudkan sebagai JSON, cast ke 'array' atau 'json' akan lebih tepat.
        // Namun, karena ada relasi BelongsToMany, kolom ini kemungkinan adalah teks biasa.
    ];

    /**
     * Relasi ke model User.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Education (dari cabang main).
     * @return HasMany
     */
    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    /**
     * Relasi ke model Experience (dari cabang main).
     * @return HasMany
     */
    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Relasi ke model Certification (dari cabang main).
     * @return HasMany
     */
    public function certifications(): HasMany
    {
        return $this->hasMany(Certification::class);
    }

    /**
     * Relasi many-to-many ke Hard Skills (dari cabang main).
     * @return BelongsToMany
     */
    public function hardSkills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'applicant_hard_skill');
    }
    
    /**
     * Relasi many-to-many ke Soft Skills (dari cabang main).
     * @return BelongsToMany
     */
    public function softSkills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'applicant_soft_skill');
    }

    /**
     * Relasi ke model JobApplication (dari cabang main).
     * @return HasMany
     */
    public function jobApplications(): HasMany
    {
        return $this->hasMany(\App\Models\JobApplication::class);
    }
}