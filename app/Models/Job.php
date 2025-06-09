<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    use HasFactory;
    protected $guarded = []; // Izinkan mass assignment untuk semua kolom

    // Sesuaikan kolom tanggal di sini
    // Berdasarkan data 'jobs' Anda, kolom tanggal adalah created_at dan updated_at.
    // Jika ada kolom deadline di jobs, tambahkan juga di sini.
    // Kolom gaji_min/max, bidang tidak perlu di protected $dates
    protected $dates = ['created_at', 'updated_at']; // Hanya ini yang otomatis di-cast Carbon

    public function company(): BelongsTo
    {
        // Parameter opsional tidak diperlukan jika foreign key adalah company_id dan local key adalah id
        return $this->belongsTo(Company::class);
    }
}