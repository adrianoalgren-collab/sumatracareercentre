<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Artikel extends Model
{
    protected $table = 'artikel';

    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'kategori',
        'ringkasan',
        'konten',
        'gambar_utama',
        'waktu_baca_menit',
        'tags',
        'penulis_nama',
        'penulis_jabatan',
        'penulis_foto',
        'penulis_bio',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    protected function tanggalLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)
                ->translatedFormat('d F Y'),
        );
    }

    protected function waktuBacaLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->waktu_baca_menit . ' menit baca',
        );
    }

    protected function tagsArray(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tags
                ? array_map('trim', explode(',', $this->tags))
                : [],
        );
    }
}