<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'course_id', // Add 'course_id' to fillable attributes
        // Add other fields if needed
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guard = 'student';

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function mcqResponses()
    {
        return $this->hasMany(Mcqresponse::class);
    }

    public function bloomResponses()
    {
        return $this->hasMany(Bloomsresponse::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_student')
            ->withTimestamps()
            ->withPivot('completed_at');
    }
}
