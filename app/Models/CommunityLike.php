<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityLike extends Model
{
    protected $fillable = ['user_id', 'community_id'];

    public function community()
    {
        return $this->belongsTo(\App\Models\Community::class, 'community_id');
    }
}
