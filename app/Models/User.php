<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
        // Method untuk mengecek role
    // public function hasRole($role)
    // {
    //     return $this->role === $role;
    // }
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function applicant()
    {
        return $this->hasOne(Applicant::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function preferred_type_of_work()
    {
        return $this->type_of_work;  // Menyesuaikan dengan atribut pengguna
    }

    // TAMBAHAN UNTUK COMPANY MANAGEMENT - RELASI KE COMPANY
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    // TAMBAHAN UNTUK JOB MANAGEMENT (jika diperlukan)
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    // TAMBAHAN SCOPE UNTUK PENCARIAN (opsional, untuk mendukung fitur search)
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    // TAMBAHAN SCOPE UNTUK FILTER ROLE (opsional)
    public function scopeByRole($query, $role)
    {
        if ($role && $role !== 'all') {
            return $query->where('role', $role);
        }
        return $query;
    }
}