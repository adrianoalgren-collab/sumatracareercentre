<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerLesson extends Model
{
    use HasFactory;

    protected $table = 'career_lessons';

    protected $fillable = [
        'class_id',
        'judul',
        'tipe_konten',
        'konten',
        'file_path',
        'urutan',
        'durasi_menit',
    ];

    /**
     * Kelas tempat lesson ini berada.
     */
    public function kelas()
    {
        return $this->belongsTo(CareerClass::class, 'class_id');
    }

    /**
     * Semua progress user untuk lesson ini.
     */
    public function progress()
    {
        return $this->hasMany(CareerLessonProgress::class, 'lesson_id');
    }

    /**
     * URL video publik, hanya terisi kalau tipe_konten-nya video
     * dan file_path-nya ada. Dipakai di view supaya tidak perlu
     * @php asset('storage/'.$lesson->file_path) di Blade.
     */
    protected function videoUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->file_path && $this->tipe_konten === 'video'
                ? asset('storage/'.$this->file_path)
                : null,
        );
    }
}