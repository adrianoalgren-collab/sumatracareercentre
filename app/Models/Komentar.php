<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';

    protected $fillable = [
        'lowongan_id',
        'user_id',
        'nama_user',
        'isi_komentar'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI KE LOWONGAN
    |--------------------------------------------------------------------------
    */
    public function lowongan()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'lowongan_id');
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI KE USER (OPTIONAL)
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}