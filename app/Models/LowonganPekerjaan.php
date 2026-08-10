<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class LowonganPekerjaan extends Model
{
    protected $table = 'lowongan_pekerjaan';
    protected $casts = [
        'deadline' => 'date',
    ];

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

    protected function persenTerisi(): Attribute
    {
        return Attribute::get(function () {
            $kuota = $this->jumlah_lowongan_dibuka ?? 0;
            $terisi = $this->total_pendaftar ?? 0;

            return $kuota > 0 ? min(100, ($terisi / $kuota) * 100) : 0;
        });
    }

    protected function sisaHari(): Attribute
    {
        return Attribute::get(function () {
            $selesai = $this->deadline;

            if (!$selesai) {
                return null;
            }

            $selesaiDay = $selesai->copy()->startOfDay();
            $todayDay = now()->startOfDay();
            $sisaAbs = $todayDay->diffInDays($selesaiDay);

            return $selesaiDay->isPast() ? -$sisaAbs : $sisaAbs;
        });
    }

    protected function persenDeadline(): Attribute
    {
        return Attribute::get(function () {
            $mulai = $this->tanggal_publish ?? $this->created_at;
            $selesai = $this->deadline;

            if (!$mulai || !$selesai) {
                return 0;
            }

            $mulaiDay = $mulai->copy()->startOfDay();
            $selesaiDay = $selesai->copy()->startOfDay();
            $todayDay = now()->startOfDay();

            $totalHari = max(1, $mulaiDay->diffInDays($selesaiDay));
            $elapsedAbs = $mulaiDay->diffInDays($todayDay);
            $terlewat = $mulaiDay->isFuture() ? 0 : min($totalHari, $elapsedAbs);

            return min(100, ($terlewat / $totalHari) * 100);
        });
    }

    protected function deadlineTone(): Attribute
    {
        return Attribute::get(function () {
            $sisa = $this->sisa_hari;

            if ($sisa === null) {
                return 'normal';
            }

            if ($sisa < 0) {
                return 'habis';
            }

            return $sisa <= 3 ? 'mepet' : 'normal';
        });
    }
}