<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'exam_name',
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    public function questionchapter()
    {
        return $this->belongsTo(QuestionChapter::class);
    }
}
