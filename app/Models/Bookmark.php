<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = 'bookmark';

    protected $fillable = [
        'user_id',
        'lowongan_id'
    ];

    public function lowongan()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'lowongan_id');
    }
}