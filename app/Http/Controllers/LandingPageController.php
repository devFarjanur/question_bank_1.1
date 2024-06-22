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

        return view('main.course');
    }


    public function about()
    {
        return view('main.about');
    }


    public function contact()
    {
        return view('main.contact');
    }




}
