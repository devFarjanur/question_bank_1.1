<?php

namespace App\Http\Controllers;


use App\Models\Admin;
use App\Models\Course;
use App\Models\Questioncreator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class CourseTeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:questioncreator');
    }

    public function CourseTeacherLogout(Request $request): RedirectResponse
    {
        Auth::guard('questioncreator')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/course-teacher/login');
    }


    public function CourseTeacherProfile()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $profileData = Questioncreator::find($id);
            return view('courseteacher.courseteacher_profile_view', compact('profileData'));
        } else {
            return redirect('/course-teacher/login');
        }
    }

    public function CourseTeacherProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = Questioncreator::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->photo = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Course Teacher Profile Updated Successfully',
            'alter-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CourseTeacherChangePassword()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $profileData = Questioncreator::find($id);
            return view('courseteacher.courseteacher_change_password', compact('profileData'));
        } else {
            return redirect('/course-teacher/login');
        }
    }

    public function CourseTeacherUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => 'Old Password does not match',
                'alert-type' => 'error',
            );

            return back()->with($notification);
        }

        Questioncreator::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function CourseTeacherCourse(){


        $courseteacher = Auth::user();
    
        // Retrieve the assigned course for the user
        $assignedCourse = $courseteacher->course;


        return view('courseteacher.course.courseteacher_course', compact('assignedCourse'));
    }




}
