<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function home()
    {
        $courses = Course::all();
        $courses = Course::with('questioncreators')->get();
        return view('main.index', compact('courses'));
    }


    public function course()
    {
        $courses = Course::all();
        $courses = Course::with('questioncreators')->get();
        return view('main.courses', compact('courses'));
    }


    public function about()
    {
        $courses = Course::all();
        $courses = Course::with('questioncreators')->get();
        return view('main.about', compact('courses'));
    }


    public function contact()
    {
        return view('main.contact');
    }




}
