<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Lamaran extends Model
{
    protected $table = 'lamaran';

    protected $fillable = [
        'user_id',
        'lowongan_id',
        'document_id',
        'surat_lamaran',
        'nama',
        'email',
        'phone',
        'address',
        'status',
        'jadwal_interview',
        'lokasi_interview',
        'catatan_interview',
    ];

    protected $casts = [
        'jadwal_interview' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lowongan()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'lowongan_id');
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'diterima' => 'Diterima',
                'ditolak' => 'Ditolak',
                'interview' => 'Dipanggil Interview',
                default => 'Menunggu Review',
            },
        );
    }

    protected function statusTagClass(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'diterima' => 'tag-success',
                'ditolak' => 'tag-danger',
                'interview' => 'tag-type',
                default => 'tag-open',
            },
        );
    }
}