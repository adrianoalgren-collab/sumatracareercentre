<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';

    protected $fillable = [
        'nama_perusahaan',
        'email_perusahaan',
        'telepon_perusahaan',
        'alamat_perusahaan',
        'website_perusahaan',
        'status_perusahaan',
    ];

    public function lowonganPekerjaan()
    {
        return $this->hasMany(LowonganPekerjaan::class, 'perusahaan_id');
    }
}