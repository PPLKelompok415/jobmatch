<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Diperlukan untuk factory model
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Diperlukan untuk relasi company()
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Diperlukan untuk relasi skill
use Illuminate\Database\Eloquent\Relations\HasMany; // Diperlukan untuk relasi jobApplications()

class Job extends Model
{
    use HasFactory; // Menggunakan trait HasFactory

    // Atribut yang dapat diisi secara massal
    protected $fillable = [
        'company_id',
        'title',
        'type_of_work',
        'location',
        'gaji_min',         // Asumsi ini adalah kolom gaji minimum
        'gaji_max',         // Asumsi ini adalah kolom gaji maksimum
        'bidang',           // Asumsi ini adalah kolom kategori/bidang pekerjaan
        'job_description',  // Menambahkan ini karena sangat relevan dengan pekerjaan
        'deadline',         // Menambahkan ini karena sering ada di pekerjaan
        'description',      // Jika ada kolom deskripsi lain selain job_description
        // Anda bisa menambahkan kolom lain yang relevan dengan pekerjaan di sini.
    ];

    // Kolom tanggal yang akan otomatis di-cast ke instance Carbon
    protected $dates = [
        'created_at',
        'updated_at',
        'deadline', // Asumsi 'deadline' adalah kolom tanggal
    ];

    // Casting tipe data untuk atribut tertentu
    protected $casts = [
        'gaji_min' => 'integer', // Pastikan gaji di-cast sebagai integer
        'gaji_max' => 'integer', // Pastikan gaji di-cast sebagai integer
        // 'bidang' tidak perlu di-cast jika itu string biasa.
    ];

    /**
     * Relasi ke model Company.
     * Sebuah pekerjaan dimiliki oleh satu perusahaan.
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        // Parameter opsional tidak diperlukan jika foreign key adalah company_id dan local key adalah id
        return $this->belongsTo(Company::class);
    }

    /**
     * Relasi many-to-many untuk hard skill yang dibutuhkan oleh pekerjaan ini (dari cabang main).
     * Menggunakan pivot table 'job_hard_skill'.
     * @return BelongsToMany
     */
    public function requiredHardSkills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'job_hard_skill');
    }

    /**
     * Relasi many-to-many untuk soft skill yang dibutuhkan oleh pekerjaan ini (dari cabang main).
     * Menggunakan pivot table 'job_soft_skill'.
     * @return BelongsToMany
     */
    public function requiredSoftSkills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'job_soft_skill');
    }

    /**
     * Relasi ke model JobApplication.
     * Sebuah pekerjaan dapat memiliki banyak lamaran pekerjaan.
     * @return HasMany
     */
    public function jobApplications(): HasMany
    {
        return $this->hasMany(\App\Models\JobApplication::class);
    }

    // Relasi 'skills()', 'hardSkills()', dan 'softSkills()' yang lebih umum dari cabang 'main'
    // telah dihapus untuk menghindari redundansi dengan 'requiredHardSkills()' dan 'requiredSoftSkills()',
    // kecuali jika ada tujuan yang berbeda untuk relasi tersebut.
}