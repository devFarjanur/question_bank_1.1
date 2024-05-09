<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_name',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    public function questionChapter()
    {
        return $this->belongsTo(QuestionChapter::class, 'questionchapter_id');
    }
    

    public function questionCategory()
    {
        return $this->belongsTo(QuestionCategory::class, 'questioncategory_id');
    }
    
}
