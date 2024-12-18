<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Course;
use App\Models\QuestionCategory;
use App\Models\Student;
use App\Models\Teacher;
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
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
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
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
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


    public function AdminDashboard()
    {

        $totalCourse = Course::count();
        $totalTeacher = Teacher::where('role', 'teacher')->where('approved', true)->count();
        $totalStudent = Student::where('role', 'student')->where('approved', true)->count();

        $teachers = Teacher::where('role', 'teacher')->where('approved', true)->get();
        $students = Student::where('role', 'student')->where('approved', true)->get();


        $categories = QuestionCategory::all();


        return view('admin.index', compact('totalCourse', 'totalTeacher', 'totalStudent', 'teachers', 'students', 'categories'));

    }


    public function deleteTeacher($id)
    {
        $teacher = Teacher::find($id);

        if ($teacher) {
            $teacher->delete();
            $notification = array(
                'message' => 'Teacher deleted successfully.',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Teacher not found.',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('admin.dashboard')->with($notification);
    }

    public function deleteStudent($id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            $notification = array(
                'message' => 'Student deleted successfully.',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Student not found.',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('admin.dashboard')->with($notification);
    }




    public function AdminCourse()
    {
        $courses = Course::all();
        return view('admin.course.admin_course', compact('courses'));
    }


    public function AdminCourseCreate()
    {
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



    public function editCourse($id)
    {
        $course = Course::find($id);
        return view('admin.course.edit_course', compact('course'));
    }

    public function updateCourse(Request $request, $id)
    {
        $validatedData = $request->validate([
            'coursename' => 'required|string|max:255',
            'coursedescription' => 'required|string|max:255',
        ]);

        $course = Course::find($id);
        $course->name = $request->coursename;
        $course->description = $request->coursedescription;
        $course->save();

        $notification = array(
            'message' => 'Course updated successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.course')->with($notification);
    }

    public function deleteCourse($id)
    {
        $course = Course::find($id);
        if ($course) {
            $course->delete();
            $notification = array(
                'message' => 'Course deleted successfully.',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Course not found.',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('admin.course')->with($notification);
    }




    public function AdminCourseTeacher()
    {
        // Fetch pending course teacher requests where approved is false
        $pendingRequests = Teacher::where('role', 'teacher')->where('approved', false)->get();

        return view('admin.courseteacher.course_teacher', compact('pendingRequests'));
    }



    public function AdminApproveCourseTeacher($id)
    {
        $courseteacher = Teacher::find($id);
        if ($courseteacher) {
            $courseteacher->approved = true;
            $courseteacher->save();
        }


        // Redirect back with a success message
        $notification = array(
            'message' => 'Course Teacher approved successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.course.teacher')->with($notification);


    }




    public function rejectCourseTeacher($id)
    {
        $request = Teacher::find($id);
        $request->status = 'rejected';
        $request->delete();


        // Redirect back with a success message
        $notification = array(
            'message' => 'Teacher rejected successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.course.teacher')->with($notification);
    }



    public function AdminCourseStudent()
    {
        // Fetch pending student requests where role is 'student' and approved is false
        $pendingStudentRequests = Student::where('role', 'student')->where('approved', false)->get();

        return view('admin.student.student', compact('pendingStudentRequests'));
    }


    public function AdminApproveCourseStudent($id)
    {
        $coursestudent = Student::find($id);
        if ($coursestudent) {
            $coursestudent->approved = true;
            $coursestudent->save();
        }


        // Redirect back with a success message
        $notification = array(
            'message' => 'Student approved successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.course.student')->with($notification);


    }


    public function rejectCourseStudent($id)
    {
        $request = Student::find($id);
        $request->status = 'rejected';
        $request->delete();


        // Redirect back with a success message
        $notification = array(
            'message' => 'Student rejected successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.course.teacher')->with($notification);
    }



    public function AdminQuestionCategory()
    {
        $categories = QuestionCategory::all();
        return view('admin.admin_questioncategory.admin_questioncategory', compact('categories'));

    }



    public function AdminQuestionCategoryCreate()
    {
        return view('admin.admin_questioncategory.admin_create_questioncategory');
    }



    public function AdminQuestionCategoryStore(Request $request)
    {
        $validatedData = $request->validate([
            'questionCategory' => 'required|string|max:255', // Update the field name
        ]);

        $questionCategory = new QuestionCategory();
        $questionCategory->name = $request->questionCategory; // Update the field name
        $questionCategory->save();

        $notification = array(
            'message' => 'Question category created successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.dashboard')->with($notification);

    }


    public function editQuestionCategory($id)
    {
        $category = QuestionCategory::find($id);
        return view('admin.admin_questioncategory.admin_update_questioncategory', compact('category'));
    }

    public function updateQuestionCategory(Request $request, $id)
    {
        $validatedData = $request->validate([
            'questionCategory' => 'required|string|max:255',
        ]);

        $category = QuestionCategory::find($id);
        $category->name = $request->questionCategory;
        $category->save();

        $notification = array(
            'message' => 'Question category updated successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.dashboard')->with($notification);
    }

    public function deleteQuestionCategory($id)
    {
        $category = QuestionCategory::find($id);
        if ($category) {
            $category->delete();
            $notification = array(
                'message' => 'Question category deleted successfully.',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Question category not found.',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('admin.dashboard')->with($notification);
    }







}
