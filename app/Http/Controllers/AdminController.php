<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminCourse()
    {
        return view('admin.admin_course');
    }




}
