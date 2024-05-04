<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionChapter extends Model
{
    protected $table = 'question_chapters';

    // Define the fillable attributes of the model
    protected $fillable = [];

    // Define the relationship with the Question model

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questionCategory()
    {
        return $this->belongsTo(QuestionCategory::class);
    }


}