<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'applicant_id',
        'institution',
        'major',
        'graduation_year'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}

