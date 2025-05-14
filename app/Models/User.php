<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
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
}