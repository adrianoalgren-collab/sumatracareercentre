<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyaratUmum extends Model
{
    protected $table = 'syarat_umum';

    protected $fillable = [
        'lowongan_id',
        'syarat_umum'
    ];

    public function lowongan()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'lowongan_id');
    }
}