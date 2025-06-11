<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [        
    'user_id',
    'logo',
    'company_name',
    'company_address',
    'website_address',
    'company_email',
    'company_phone_number',
    'position',
    'type_of_work',
    'location',
    'salary_min',
    'salary_max',
    'deadline',
    'job_description',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function companyData()
    {
        return $this->hasOne(Company::class);
    }
      /**
     * Accessor untuk nama perusahaan dengan fallback
     */
    public function getCompanyDisplayNameAttribute()
    {
        return $this->company_name ?? $this->user->name ?? 'Nama tidak tersedia';
    }

    /**
     * Accessor untuk email perusahaan dengan fallback
     */
    public function getCompanyDisplayEmailAttribute()
    {
        return $this->company_email ?? $this->user->email ?? '';
    }

    /**
     * Scope untuk filter berdasarkan industri (jika ada kolom industry)
     */
    public function scopeByIndustry($query, $industry)
    {
        if ($industry && $industry !== 'all') {
            return $query->where('industry', $industry);
        }
        return $query;
    }

    /**
     * Scope untuk pencarian
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

