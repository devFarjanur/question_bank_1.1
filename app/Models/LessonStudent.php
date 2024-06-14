<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LessonStudent extends Pivot
{
    protected $table = 'lesson_student';

    protected $fillable = ['student_id', 'lesson_id', 'completed_at'];

    protected $casts = [
        'completed_at' => 'datetime',
    ];
}
