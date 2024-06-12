<?php

namespace App\Http\Controllers;


use App\Models\Admin;
use App\Models\BLOOMS;
use App\Models\Bloomsresponse;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Lesson;
use App\Models\MCQ;
use App\Models\Mcqresponse;
use App\Models\QuestionCategory;
use App\Models\QuestionChapter;
use App\Models\Questioncreator;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
        return redirect('/');
    }


    public function StudentProfile()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $profileData = Student::find($id);
            return view('student.student_profile_view', compact('profileData'));
        } else {
            return redirect('/');
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
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
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
            return redirect('/');
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


    // public function StudentCourse()
    // {


    //     $coursestudent = Auth::user();

    //     // Retrieve the assigned course for the user
    //     $assignedCourse = $coursestudent->course;


    //     return view('student.course.student_course', compact('assignedCourse'));
    // }


    public function CourseStudentLesson()
    {
        $student = Auth::user();
        $assignedCourse = $student->course;

        if (!$assignedCourse) {
            return redirect()->back()->with('error', 'No course assigned.');
        }

        $lessons = $assignedCourse->lessons;
        return view('student.lesson.student_lesson', compact('lessons', 'assignedCourse'));
    }

    public function showLesson(Lesson $lesson)
    {
        if ($lesson->video_url) {
            $lesson->video_url = $this->convertToEmbedUrl($lesson->video_url);
        }
        return view('courseteacher.lesson.student_lessonshow', compact('lesson'));
    }

    private function convertToEmbedUrl($url)
    {
        if (strpos($url, 'youtu.be') !== false) {
            // Extract video ID from youtu.be URL
            $urlParts = parse_url($url);
            $videoId = ltrim($urlParts['path'], '/');
            return 'https://www.youtube.com/embed/' . $videoId;
        } elseif (strpos($url, 'youtube.com/watch') !== false) {
            // Extract video ID from youtube.com URL
            $queryString = parse_url($url, PHP_URL_QUERY);
            parse_str($queryString, $queryParams);
            return 'https://www.youtube.com/embed/' . $queryParams['v'];
        }
        return $url; // Return original URL if it's not a YouTube URL
    }




    public function StudentExam()
    {
        $courseId = auth()->user()->course_id;

        // Retrieve exams with their associated question chapters and question categories
        $exams = Exam::with('questionChapter', 'questionCategory')
            ->where('course_id', $courseId)
            ->get();

        // Pass the exams data to the view
        return view('student.exam.student_exam', compact('exams'));
    }



    public function StudentMcqExam($id)
    {
        $student = auth()->user();

        // Check if the student has already submitted the exam
        if ($student->mcqResponses()->where('exam_id', $id)->exists()) {
            $notification = [
                'message' => 'You have already submitted this exam.',
                'alert-type' => 'error',
            ];

            return redirect()->route('student.exam')->with($notification);
        }

        // Continue with loading the exam page if the student has not submitted it

        $courseId = $student->course_id;

        $exam = Exam::findOrFail($id);

        $questionchapter = QuestionChapter::findOrFail($id);

        // Retrieve the MCQs with specific question chapter and category IDs
        $mcqs = MCQ::where('questionchapter_id', $id)
            ->whereHas('questionChapter', function ($query) use ($questionchapter) {
                $query->where('questioncategory_id', $questionchapter->questioncategory_id);
            })
            ->get();

        // Pass the question category ID to the view
        $questionCategoryId = $questionchapter->questioncategory_id;

        return view('student.exam.student_mcq_exam', compact('exam', 'courseId', 'questionchapter', 'mcqs', 'questionCategoryId'));
    }



    public function StudentMcqExamSubmit(Request $request, $id)
    {

        $student = auth()->user();

        // Check if the student has already submitted the exam
        if ($student->mcqResponses()->where('exam_id', $id)->exists()) {
            $notification = [
                'message' => 'You have already submitted this exam.',
                'alert-type' => 'error',
            ];

            return redirect()->route('student.exam')->with($notification);
        }

        // Get the course ID, question chapter ID, and question category ID from the request
        $courseId = $request->input('course_id');
        $questionChapterId = $request->input('questionchapter_id');
        $questionCategoryId = $request->input('questioncategory_id');

        // Validate the form data
        $validatedData = $request->validate([
            'option.*' => 'required|string', // Validation for options selected
        ]);

        $exam = Exam::findOrFail($id);

        // Loop through the responses and store them
        foreach ($validatedData['option'] as $mcqId => $responseOption) {
            $response = new Mcqresponse();
            $response->student_id = $student->id;
            $response->exam_id = $exam->id;
            $response->course_id = $courseId;
            $response->questioncategory_id = $questionCategoryId;
            $response->questionchapter_id = $questionChapterId;
            $response->m_c_q_id = $mcqId;
            $response->response_option = $responseOption;
            $response->save();
        }

        $notification = [
            'message' => 'MCQ Exam submitted successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('student.exam')->with($notification);
    }




    public function StudentBloomsExam($id)
    {
        $courseId = auth()->user()->course_id;



        $exam = Exam::findOrFail($id);

        $questionchapter = QuestionChapter::findOrFail($id);

        $questions = BLOOMS::where('questionchapter_id', $id)
            ->whereHas('questionChapter', function ($query) use ($questionchapter) {
                $query->where('questioncategory_id', $questionchapter->questioncategory_id);
            })
            ->get()->groupBy('bloom_taxonomy');

        $questionCategoryId = $questionchapter->questioncategory_id;

        return view('student.exam.student_blooms_exam', compact('courseId', 'exam', 'questionCategoryId', 'questionchapter', 'questions'));
    }

    public function StudentBloomsExamSubmit(Request $request, $id)
    {


        $student = auth()->user();
        // Get the course ID, question chapter ID, and question category ID from the request
        $courseId = $request->input('course_id');
        $questionChapterId = $request->input('questionchapter_id');
        $questionCategoryId = $request->input('questioncategory_id');




        // Validate the form data
        $validatedData = $request->validate([
            'bloom_ids.*' => 'required|exists:b_l_o_o_m_s,id',
            'response_answers.*' => 'required|string',
            'marks' => 'nullable|array', // marks is an array
            'marks.*' => 'nullable|string', // each mark is a string
        ]);


        $exam = Exam::findOrFail($id);


        // Loop through the responses and store them
        foreach ($validatedData['bloom_ids'] as $key => $bloomId) {
            $response = new Bloomsresponse();
            $response->student_id = $student->id;
            $response->course_id = $courseId;
            $response->questioncategory_id = $questionCategoryId;
            $response->questionchapter_id = $questionChapterId;
            $response->b_l_o_o_m_id = $bloomId;
            $response->exam_id = $exam->id;
            $response->response_answer = $validatedData['response_answers'][$key];
            // Check if marks are provided for the current response
            if (isset($validatedData['marks'][$key])) {
                $response->marks = $validatedData['marks'][$key];
            }
            $response->save();
        }

        $notification = [
            'message' => 'Blooms Answers Submitted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('student.exam')->with($notification);
    }


    public function StudentExamResult()
    {
        // Get the current student's Blooms responses
        $bloomsResponses = Bloomsresponse::where('student_id', auth()->user()->id)->get();

        // Initialize array to store Blooms exam scores
        $bloomsScores = [];

        // Loop through Blooms responses to calculate total exam scores
        foreach ($bloomsResponses as $response) {
            // Extract necessary information from the response
            $examName = $response->exam->exam_name;
            $questionChapterName = $response->exam->questionchapter->name;
            $questionCategoryName = $response->exam->questioncategory->name;
            $marks = $response->marks;

            // Check if the exam exists in the array
            if (!isset($bloomsScores[$examName][$questionChapterName][$questionCategoryName])) {
                $bloomsScores[$examName][$questionChapterName][$questionCategoryName] = 0;
            }

            // Add marks to the corresponding exam, question chapter, and category
            $bloomsScores[$examName][$questionChapterName][$questionCategoryName] += $marks;
        }

        // Pass the Blooms exam scores to the student exam result view
        return view('student.result.student_exam_result', compact('bloomsScores'));
    }



}
