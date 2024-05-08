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



    public function CourseTeacherQuestionCategory()
    {
        $categories = QuestionCategory::all();
        return view('courseteacher.question.courseteacher_questioncategory', compact('categories'));

    }



    public function CourseTeacherQuestionChapter($categoryId){
        $category = QuestionCategory::findOrFail($categoryId);
        // Fetch only the question chapters associated with the current course teacher's course
        $questionchapters = QuestionChapter::where('questionCategory_id', $categoryId)
            ->where('course_id', auth()->user()->course_id) // Filter by the current course teacher's course ID
            ->with('course')
            ->get();
        return view('courseteacher.question.courseteacher_questionchapter', compact('questionchapters', 'categoryId', 'category'));
    }
    


    public function CourseTeacherQuestionChapterAdd($id)
    {
        $category = QuestionCategory::findOrFail($id);
        return view('courseteacher.question.courseteacher_add_questionchapter', ['category' => $category]);
    }
    


    public function CourseTeacherQuestionChapterStore(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'questionchapter' => 'required|string|max:255',
        ]);
    
        // Retrieve the authenticated user
        $userId = Auth::id();
        $user = Questioncreator::findOrFail($userId);
    
        // Retrieve the course ID associated with the user
        $courseId = $user->course_id;
    
        // Fetch the category based on the provided ID
        $category = QuestionCategory::findOrFail($id);
    
        // Create a new QuestionSet instance
        $questionchapter = new QuestionChapter();
        $questionchapter->name = $validatedData['questionchapter'];
        $questionchapter->course_id = $courseId;
        $questionchapter->questionCategory_id = $category->id;
    
        // Save the question set to the database
        $questionchapter->save();
    
        // Redirect back with a success message
        $notification = [
            'message' => 'Question Chapter Added Successfully',
            'alert-type' => 'success'
        ];
    
        // Redirect to the appropriate route with the necessary parameters
        return redirect()->route('course.teacher.question.chapter', ['id' => $category->id])->with($notification);
    }

    public function CourseTeacherMCQ($chapterId)
    {
        $questionchapter = QuestionChapter::findOrFail($chapterId);
        $mcqs = MCQ::where('questionchapter_id', $chapterId)->get();
        return view('courseteacher.question.courseteacher_mcq', compact('questionchapter', 'mcqs'));
    }
    

    public function CourseTeacherMcqAdd($id){
        $questionchapter = QuestionChapter::findOrFail($id);
        // Pass the $id variable to the view
        return view('courseteacher.question.courseteacher_add_mcq', compact('questionchapter', 'id'));
    }
    


    public function CourseTeacherMcqStore(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'question.*' => 'required',
            'optionA.*' => 'required',
            'optionB.*' => 'required',
            'optionC.*' => 'required',
            'optionD.*' => 'required',
            'correct_option.*' => 'required|in:a,b,c,d',
        ]);
    
        // Find the question chapter by its ID
        $questionChapter = QuestionChapter::findOrFail($id);
    
        // Loop through the questions and insert into the database
        foreach ($validatedData['question'] as $key => $questionText) {
            $mcq = new MCQ();
            $mcq->course_id = $questionChapter->course_id; // Assign the course ID from the question chapter
            $mcq->questionchapter_id = $questionChapter->id; // Assign the question chapter ID
            $mcq->question_text = $questionText;
            $mcq->option_a = $validatedData['optionA'][$key];
            $mcq->option_b = $validatedData['optionB'][$key];
            $mcq->option_c = $validatedData['optionC'][$key];
            $mcq->option_d = $validatedData['optionD'][$key];
            $mcq->correct_option = $validatedData['correct_option'][$key];
            $mcq->save();
        }
    
        // Redirect back with success message
        $notification = [
            'message' => 'MCQ Question(s) Added Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('course.teacher.mcq', ['chapterId' => $id])->with($notification);
    }
    
    


    // public function CourseTeacherBlooms($chapterId)
    // {


    //     $questionchapter = QuestionChapter::findOrFail($chapterId);
    //     $blooms = BLOOMS::where('questionchapter_id', $chapterId)->get();
    //     return view('courseteacher.question.courseteacher_blooms', compact('questionchapter', 'blooms'));


    // }



    public function CourseTeacherBlooms($chapterId)
    {
        $questionchapter = QuestionChapter::findOrFail($chapterId);

        $questions = BLOOMS::where('questionchapter_id', $chapterId)->get()->groupBy('bloom_taxonomy');
    
        return view('courseteacher.question.courseteacher_blooms', compact('questionchapter', 'questions'));
    }
    

    public function CourseTeacherBloomsAdd($id){
        $questionchapter = QuestionChapter::findOrFail($id);
        // $blooms = BLOOMS::where('questionchapter_id', $id)
        // ->where('course_id', auth()->user()->course_id) // Filter by the current course teacher's course ID
        // ->with('course')
        // ->get();
        return view('courseteacher.question.courseteacher_add_blooms', compact('questionchapter', 'id'));
    }


    public function CourseTeacherBloomsStore(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'question_description' => 'required|string',
            'question_text.*' => 'required|string',
            'bloom_taxonomy.*' => 'required|string',
            'question_mark.*' => 'required|string',
            // Add validation for other fields as needed
        ]);
    
        // Find the question chapter by its ID
        $questionChapter = QuestionChapter::findOrFail($id);
    
        // Loop through the questions and insert into the database
        foreach ($validatedData['question_text'] as $key => $questionText) {
            $blooms = new BLOOMS();
            $blooms->course_id = $questionChapter->course_id; // Assign the course ID from the question chapter
            $blooms->questionchapter_id = $questionChapter->id; // Assign the question chapter ID
            $blooms->question_description = $validatedData['question_description']; // Fixed: Access the 'question_description' from the validated data array
            $blooms->question_text = $questionText;
            $blooms->bloom_taxonomy = $validatedData['bloom_taxonomy'][$key];
            $blooms->question_mark = $validatedData['question_mark'][$key];
            // Add other fields here if needed
            $blooms->save();
        }
    
        // Redirect back with success message
        $notification = [
            'message' => 'Bloom Question(s) Added Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('course.teacher.blooms', ['chapterId' => $id])->with($notification);
    }




    public function CourseTeacherExam()
    {
        // Retrieve the course ID associated with the authenticated user
        $courseId = auth()->user()->course_id;
    
        // Retrieve exams and question chapters associated with the course
        $exams = Exam::with('questionChapter')
                     ->where('course_id', $courseId)
                     ->get();
    
        return view('courseteacher.exam.courseteacher_exam', compact('exams'));
    }
    
    


    public function CourseTeacherCreateExam()
    {
        // Retrieve the course ID associated with the authenticated user
        $courseId = auth()->user()->course_id;
    
        $questioncategories = QuestionCategory::all();
        $mcqCategoryId = QuestionCategory::where('name', 'MCQ')->value('id');
        $bloomsCategoryId = QuestionCategory::where('name', 'BLOOMS')->value('id');
    
        // Fetch only the question chapters associated with the current course teacher
        $mcqQuestionChapters = QuestionChapter::where('questioncategory_id', $mcqCategoryId)
                                              ->where('course_id', $courseId)
                                              ->get();
        $bloomsQuestionChapters = QuestionChapter::where('questioncategory_id', $bloomsCategoryId)
                                                 ->where('course_id', $courseId)
                                                 ->get();
    
        // Initialize questionChapterId variable to null
        $questionChapterId = null;
    
        return view('courseteacher.exam.courseteacher_create_exam', compact('questioncategories', 'mcqQuestionChapters', 'bloomsQuestionChapters', 'mcqCategoryId', 'bloomsCategoryId', 'courseId', 'questionChapterId'));
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
    
    
    
    
    public function CourseTeacherStoreExam(Request $request)
    {
        // Get the course ID from the request
        $courseId = $request->input('course_id');
        // Get the question chapter ID from the request
        $questionChapterId = $request->input('questionchapter_id');

        // Validate the form data
        $validatedData = $request->validate([
            'exam_name' => 'required|string|max:255',
        ]);

        // Create a new exam instance
        $exam = new Exam();
        $exam->course_id = $courseId;
        $exam->questionchapter_id = $questionChapterId; // Ensure this value is not null
        $exam->exam_name = $validatedData['exam_name'];

        // Save the exam to the database
        $exam->save();

        // Optional: Redirect back with success message
        $notification = [
            'message' => 'Exam created successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('course.teacher.exam')->with($notification);
    }



}
