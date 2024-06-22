<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description']; // Add other fillable attributes as needed

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function questioncreators()
    {
        return $this->hasMany(Questioncreator::class);
    }


}
