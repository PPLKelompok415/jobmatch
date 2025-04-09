<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'photo', 'date_of_birth', 'gender', 'email', 'phone_number',
        'address', 'cv_file', 'portfolio_file', 'desired_position', 'type_of_work',
        'location', 'salary_min', 'salary_max', 'availability_date', 'available_now'
    ];

    public function educations() {
        return $this->hasMany(Education::class);
    }

    public function experiences() {
        return $this->hasMany(Experience::class);
    }

    public function certifications() {
        return $this->hasMany(Certification::class);
    }

    public function softSkills()
    {
        return $this->belongsToMany(Skill::class, 'applicant_skill');
    }

    public function hardSkills()
    {
        return $this->belongsToMany(Skill::class, 'applicant_skill');
    }

}
