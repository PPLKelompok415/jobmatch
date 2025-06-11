<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Pastikan ini di-import

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'job_description', // <--- DIUBAH dari 'description' menjadi 'job_description'
        'type_of_work',
        'location',
        'gaji_min',
        'gaji_max',
        'bidang',          // <--- DITAMBAHKAN
        'requirements',    // Tetap ada
        'responsibilities',// Tetap ada
        'expires_at',      // Tetap ada
        // Pastikan semua kolom lain yang bisa diisi juga ditambahkan di sini
    ];

    /**
     * Get the company that owns the job.
     */
    public function company(): BelongsTo // Menambahkan tipe return hint
    {
        return $this->belongsTo(Company::class);
    }
    
    /**
     * Get the applications for the job.
     */
    public function applications()
    {
        return $this->hasMany(Application::class); // Jika Anda memiliki model Application
    }
}
