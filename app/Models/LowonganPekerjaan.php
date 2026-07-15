<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class LowonganPekerjaan extends Model
{
    protected $table = 'lowongan_pekerjaan';

    protected $fillable = [
        'perusahaan_id',
        'judul_lowongan',
        'lokasi',
        'kategori_label',
        'deskripsi_pekerjaan',
        'deadline',
        'status_lowongan',
        'jumlah_lowongan_dibuka',
        'tanggal_deadline_label',
        'gambar_banner'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }

    public function jurusan()
    {
        return $this->hasMany(Jurusan::class, 'lowongan_id');
    }

    public function syaratKhusus()
    {
        return $this->hasMany(SyaratKhusus::class, 'lowongan_id');
    }

    public function syaratUmum()
    {
        return $this->hasMany(SyaratUmum::class, 'lowongan_id');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'lowongan_id');
    }

    public function bookmark()
    {
        return $this->hasMany(Bookmark::class, 'lowongan_id');
    }

    public function lamaran()
    {
        return $this->hasMany(Lamaran::class, 'lowongan_id');
    }

    public function sudahDilamarOleh($userId): bool
    {
        return $this->lamaran()->where('user_id', $userId)->exists();
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    protected function totalPendaftar(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->lamaran()->count(),
        );
    }

    protected function totalInterview(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->lamaran()->where('status', 'interview')->count(),
        );
    }
}