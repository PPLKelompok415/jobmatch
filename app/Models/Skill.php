<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_skill');
    }

    public function softApplicants()
    {
        return $this->belongsToMany(Applicant::class, 'applicant_soft_skill');
    }

    public function hardApplicants()
    {
        return $this->belongsToMany(Applicant::class, 'applicant_hard_skill');
    }
}
