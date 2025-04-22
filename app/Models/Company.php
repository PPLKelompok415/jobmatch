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

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function companyData()
    {
        return $this->hasOne(Company::class);
    }
}

