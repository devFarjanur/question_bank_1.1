<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionCreatorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:questioncreator');
    }

    public function QuestionCreatorLogin()
    {
        return view('questioncreator.questioncreator_login');
    }
    


    public function QuestionCreatorRegister()
    {
        return view('questioncreator.questioncreator_register');
    }





    
}
