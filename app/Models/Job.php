<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    protected $fillable = [
        'company_id',
        'title',
        'type_of_work',
        'location',
        'gaji_min',
        'gaji_max',
        'bidang',
    ];

    
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function hardSkills()
    {
        return $this->belongsToMany(\App\Models\Skill::class, 'job_skill');
    }

    public function softSkills()
    {
        return $this->belongsToMany(\App\Models\Skill::class, 'job_skill');
    }

    public function requiredHardSkills()
    {
        return $this->belongsToMany(Skill::class, 'job_hard_skill');
    }

    public function requiredSoftSkills()
    {
        return $this->belongsToMany(Skill::class, 'job_soft_skill');
    }

    public function jobApplications()
    {
        return $this->hasMany(\App\Models\JobApplication::class);
    }



}
