<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloomsresponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'course_id', 'questioncategory_id', 'questionchapter_id', 'b_l_o_o_m_id', 'exam_id', 'response_answer', 'marks',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questioncategory()
    {
        return $this->belongsTo(QuestionCategory::class, 'questioncategory_id');
    }

    public function questionchapter()
    {
        return $this->belongsTo(QuestionChapter::class, 'questionchapter_id');
    }

    public function bloomsQuestion()
    {
        return $this->belongsTo(BLOOMS::class, 'b_l_o_o_m_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}