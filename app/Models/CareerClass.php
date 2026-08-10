<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerClass extends Model
{
    use HasFactory;

    protected $table = 'career_classes';

    protected $fillable = [
        'judul',
        'deskripsi',
        'thumbnail',
        'status',
        'dibuat_oleh',
    ];

    /**
     * Admin yang membuat kelas ini.
     */
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    /**
     * Semua lesson dalam kelas ini, diurutkan sesuai kolom 'urutan'.
     */
    public function lessons()
    {
        return $this->hasMany(CareerLesson::class, 'class_id')->orderBy('urutan');
    }

    /**
     * Semua pendaftaran (enrollment) untuk kelas ini.
     */
    public function enrollments()
    {
        return $this->hasMany(CareerEnrollment::class, 'class_id');
    }

    /**
     * Scope untuk kelas yang sudah dipublikasikan (untuk sisi pelamar).
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}