<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcqresponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'questioncategory_id',
        'questionchapter_id',
        'm_c_q_id',
        'exam_id',
        'response_option',
        'marks',
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

    public function mcq()
    {
        return $this->belongsTo(MCQ::class, 'm_c_q_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}