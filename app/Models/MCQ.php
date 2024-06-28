<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Exam;

class MCQ extends Model
{
    protected $fillable = [
        'course_id',
        'questionchapter_id',
        'question_text',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_option'
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questionchapter()
    {
        return $this->belongsTo(QuestionChapter::class);
    }

    public function responses()
    {
        return $this->hasMany(Mcqresponse::class, 'm_c_q_id');
    }


}