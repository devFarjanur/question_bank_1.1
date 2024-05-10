<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcqresponse extends Model
{
    use HasFactory;

    protected $fillable = [

        'response_option',
        'marks'
     
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function m_c_q()
    {
        return $this->belongsTo(MCQ::class);
    }

}