<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;
    protected $guarded = []; // Izinkan mass assignment untuk semua kolom
    // Jika ada kolom tanggal lain di companies, tambahkan di sini:
    // protected $dates = ['created_at', 'updated_at'];

    public function jobs(): HasMany
    {
        // Parameter opsional tidak diperlukan jika foreign key adalah company_id dan local key adalah id
        return $this->hasMany(Job::class);
    }
}