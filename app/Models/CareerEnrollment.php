<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerEnrollment extends Model
{
    use HasFactory;

    protected $table = 'career_enrollments';

    protected $fillable = [
        'user_id',
        'class_id',
        'status',
        'enrolled_at',
        'completed_at',
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * User yang mendaftar.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Kelas yang diikuti.
     */
    public function kelas()
    {
        return $this->belongsTo(CareerClass::class, 'class_id');
    }

    /**
     * Persentase progres kelas ini, dihitung on-the-fly
     * dari jumlah lesson yang sudah diselesaikan.
     * Contoh pakai: $enrollment->progress_percent
     */
    public function getProgressPercentAttribute(): int
    {
        $totalLessons = CareerLesson::where('class_id', $this->class_id)->count();

        if ($totalLessons === 0) {
            return 0;
        }

        $completedLessons = CareerLessonProgress::where('user_id', $this->user_id)
            ->whereIn('lesson_id', CareerLesson::where('class_id', $this->class_id)->pluck('id'))
            ->whereNotNull('completed_at')
            ->count();

        return (int) round(($completedLessons / $totalLessons) * 100);
    }
}