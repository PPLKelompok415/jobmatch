<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = 'job_applications'; // Sesuaikan nama tabel

    protected $fillable = [
        'job_id',
        'applicant_id',
        'status',
    ];

    /**
     * Relasi ke model Job
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Relasi ke model Applicant
     */
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
