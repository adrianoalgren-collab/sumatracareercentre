<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerLessonProgress extends Model
{
    use HasFactory;

    protected $table = 'career_lesson_progress';

    protected $fillable = [
        'user_id',
        'lesson_id',
        'metode',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    /**
     * User pemilik progress ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lesson yang terkait.
     */
    public function lesson()
    {
        return $this->belongsTo(CareerLesson::class, 'lesson_id');
    }
}