<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloomsresponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'response_answer',
        'marks'
    ];

    /**
     * Get the course associated with the blooms response.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the exam associated with the blooms response.
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * Get the blooms question associated with the blooms response.
     */
    public function bloomsQuestion()
    {
        return $this->belongsTo(BLOOMS::class, 'b_l_o_o_m_id');
    }


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
