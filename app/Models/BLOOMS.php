<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BLOOMS extends Model
{
    protected $fillable = [
        'question_description',
        'question_text',
        'bloom_taxonomy',
        'question_mark',
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
