<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Exam;

class MCQ extends Model
{
    protected $fillable = [
        'question_text',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_option',
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    public function questionSet()
    {
        return $this->belongsTo(QuestionChapter::class);
    }


}