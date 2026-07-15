<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyaratKhusus extends Model
{
    protected $table = 'syarat_khusus';

    protected $fillable = [
        'lowongan_id',
        'syarat_khusus'
    ];

    public function lowongan()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'lowongan_id');
    }
}