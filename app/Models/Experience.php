<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'applicant_id',
        'company',
        'position',
        'working_period',
        'description'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}

