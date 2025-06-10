<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Diperlukan untuk relasi user()

class Company extends Model
{
    use HasFactory;

    // Menggunakan $fillable untuk secara eksplisit mengizinkan mass assignment
    // Daftar ini hanya mencakup atribut yang relevan untuk entitas 'Company' itu sendiri.
    // Atribut yang terkait dengan pekerjaan (position, salary, dll.) telah dihapus
    // karena seharusnya berada di model Job.
    protected $fillable = [
        'user_id',
        'logo',
        'company_name',
        'company_address',
        'website_address',
        'company_email',
        'company_phone_number',
        'industry', // Ditambahkan karena digunakan di scopeByIndustry
        // Anda bisa menambahkan kolom lain yang relevan untuk perusahaan di sini.
    ];

    /**
     * Relasi ke model User (dari cabang main).
     * Setiap perusahaan dimiliki oleh satu user (perusahaan sebagai user).
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Job (dari kedua cabang).
     * Sebuah perusahaan dapat memiliki banyak lowongan pekerjaan.
     * @return HasMany
     */
    public function jobs(): HasMany
    {
        // Parameter opsional tidak diperlukan jika foreign key adalah company_id dan local key adalah id
        return $this->hasMany(Job::class);
    }

    // Metode companyData() dihapus karena tampaknya merupakan relasi self-referencing yang tidak relevan atau salah.

    /**
     * Accessor untuk nama perusahaan dengan fallback (dari cabang main).
     * Jika company_name tidak ada, akan mencoba user->name, lalu 'Nama tidak tersedia'.
     */
    public function getCompanyDisplayNameAttribute(): string
    {
        return $this->company_name ?? $this->user->name ?? 'Nama tidak tersedia';
    }

    /**
     * Accessor untuk email perusahaan dengan fallback (dari cabang main).
     * Jika company_email tidak ada, akan mencoba user->email.
     */
    public function getCompanyDisplayEmailAttribute(): string
    {
        return $this->company_email ?? $this->user->email ?? '';
    }

    /**
     * Scope untuk filter berdasarkan industri (dari cabang main).
     * Memfilter query berdasarkan kolom 'industry'.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $industry
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByIndustry($query, $industry)
    {
        if ($industry && $industry !== 'all') {
            return $query->where('industry', $industry);
        }
        return $query;
    }

    /**
     * Scope untuk pencarian perusahaan berdasarkan nama perusahaan, email perusahaan,
     * nama user, atau email user (dari cabang main).
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('company_email', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        return $query;
    }
}