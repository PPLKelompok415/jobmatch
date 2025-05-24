<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}