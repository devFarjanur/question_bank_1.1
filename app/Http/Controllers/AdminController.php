<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminProfile()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $profileData = Admin::find($id);
            return view('admin.admin_profile_view', compact('profileData'));
        } else {
            return redirect('/admin/login');
        }
    }

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = Admin::find($id);
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
            'message' => 'Admin Profile Updated Successfully',
            'alter-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $profileData = Admin::find($id);
            return view('admin.admin_change_password', compact('profileData'));
        } else {
            return redirect('/admin/login');
        }
    }

    public function AdminUpdatePassword(Request $request)
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

        Admin::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function AdminCourse(){
        $courses = Course::all();
        return view('admin.course.admin_course', compact('courses'));
    }


    public function AdminCourseCreate(){
        return view('admin.course.admin_create_course');
    }


    public function AdminCourseStore(Request $request)
    {
        // Debugging to check form data
    
        // Validate the incoming request data
        $request->validate([
            'coursename' => 'required|string|max:255',
            'coursedescription' => 'required|string',
            // Add more validation rules if needed
        ]);
    
        // Create a new Course instance
        $course = new Course();
        $course->name = $request->input('coursename'); // Adjusted field name
        $course->description = $request->input('coursedescription'); // Adjusted field name
        
        // Debugging to check Course model instance
        // Save the course to the database
        $course->save();
    
        // Redirect back with a success message
        $notification = array(
            'message' => 'Course Added Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('admin.course')->with($notification);
    }




}
