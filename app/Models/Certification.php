<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'applicant_id',
        'file'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}

