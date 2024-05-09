<?php

namespace App\Http\Controllers;


use App\Models\Admin;
use App\Models\BLOOMS;
use App\Models\Course;
use App\Models\Exam;
use App\Models\MCQ;
use App\Models\QuestionCategory;
use App\Models\QuestionChapter;
use App\Models\Questioncreator;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function StudentLogout(Request $request): RedirectResponse
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/student/login');
    }


    public function StudentProfile()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $profileData = Student::find($id);
            return view('student.student_profile_view', compact('profileData'));
        } else {
            return redirect('/student/login');
        }
    }

    public function StudentProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = Student::find($id);
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
            'message' => 'Student Profile Updated Successfully',
            'alter-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CourseTeacherChangePassword()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $profileData = Student::find($id);
            return view('student.student_change_password', compact('profileData'));
        } else {
            return redirect('/student/login');
        }
    }

    public function StudentUpdatePassword(Request $request)
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

        Student::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }


    public function StudentCourse(){


        $coursestudent = Auth::user();
    
        // Retrieve the assigned course for the user
        $assignedCourse = $coursestudent->course;


        return view('student.course.student_course', compact('assignedCourse'));
    }




    public function StudentExam()
    {
        $courseId = auth()->user()->course_id;
    
        // Retrieve exams with their associated question chapters and question categories
        $exams = Exam::with('questionChapter', 'questionCategory')
                     ->where('course_id', $courseId)
                     ->get();
    
        // Pass the exams data to the view
        return view('courseteacher.exam.courseteacher_exam', compact('exams'));
    }

    // public function CourseTeacherQuestionChapter($categoryId){
    //     $category = QuestionCategory::findOrFail($categoryId);
    //     // Fetch only the question chapters associated with the current course teacher's course
    //     $questionchapters = QuestionChapter::where('questionCategory_id', $categoryId)
    //         ->where('course_id', auth()->user()->course_id) // Filter by the current course teacher's course ID
    //         ->with('course')
    //         ->get();
    //     return view('courseteacher.question.courseteacher_questionchapter', compact('questionchapters', 'categoryId', 'category'));
    // }


    public function StudentMCQExam($chapterId)
    {
        $questionchapter = QuestionChapter::findOrFail($chapterId);
        $mcqs = MCQ::where('questionchapter_id', $chapterId)->get();
        return view('student.exam.student_mcq_exam', compact('questionchapter', 'mcqs'));
    }


    public function StudentBloomsExam($chapterId)
    {
        $questionchapter = QuestionChapter::findOrFail($chapterId);
        $questions = BLOOMS::where('questionchapter_id', $chapterId)->get()->groupBy('bloom_taxonomy');
        return view('student.exam.student_blooms_exam', compact('questionchapter', 'questions'));
    }




}
