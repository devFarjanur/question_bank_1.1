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
use App\Models\Teacher;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class CourseTeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    public function CourseTeacherLogout(Request $request): RedirectResponse
    {
        Auth::guard('teacher')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/teacher/login');
    }


    public function CourseTeacherProfile()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $profileData = Teacher::find($id);
            return view('courseteacher.courseteacher_profile_view', compact('profileData'));
        } else {
            return redirect('/teacher/login');
        }
    }

    public function CourseTeacherProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = Teacher::find($id);
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
            'message' => 'Course Teacher Profile Updated Successfully',
            'alter-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CourseTeacherChangePassword()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $profileData = Teacher::find($id);
            return view('courseteacher.courseteacher_change_password', compact('profileData'));
        } else {
            return redirect('/teacher/login');
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

        Teacher::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function CourseTeacherCourse()
    {
        $courseteacher = Auth::user();

        // Retrieve the assigned course for the user
        $assignedCourse = $courseteacher->course;

        // Retrieve students assigned to the same course
        $students = \App\Models\Student::where('course_id', $assignedCourse->id)->where('role', 'student')->where('approved', true)->get();
        $totalStudents = \App\Models\Student::where('course_id', $assignedCourse->id)->where('role', 'student')->where('approved', true)->count();

        return view('courseteacher.course.courseteacher_course', compact('assignedCourse', 'students', 'totalStudents'));
    }



    public function CourseTeacherLesson()
    {
        $teacher = Auth::user();
        $assignedCourse = $teacher->course;

        if (!$assignedCourse) {
            return redirect()->back()->with('error', 'No course assigned.');
        }

        $lessons = $assignedCourse->lessons;
        return view('courseteacher.lesson.courseteacher_lesson', compact('lessons', 'assignedCourse'));
    }

    public function createLesson(Course $course)
    {
        return view('courseteacher.lesson.courseteacher_lessoncreate', compact('course'));
    }

    public function storeLesson(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_url' => 'nullable|url'
        ]);

        $course->lessons()->create($request->all());
        return redirect()->route('course.teacher.lesson')->with('success', 'Lesson added successfully');
    }


    public function showLesson(Lesson $lesson)
    {
        if ($lesson->video_url) {
            $lesson->video_url = $this->convertToEmbedUrl($lesson->video_url);
        }
        return view('courseteacher.lesson.courseteacher_lessonshow', compact('lesson'));
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



    public function editLesson(Lesson $lesson)
    {
        return view('courseteacher.lesson.courseteacher_lessonedit', compact('lesson'));
    }

    public function updateLesson(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_url' => 'nullable|url'
        ]);

        $lesson->update($request->all());

        $notification = array(
            'message' => 'Lesson updated successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('course.teacher.lesson')->with($notification);
    }

    public function deleteLesson(Lesson $lesson)
    {
        $lesson->delete();

        $notification = array(
            'message' => 'Lesson deleted successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('course.teacher.lesson')->with($notification);
    }






    public function CourseTeacherQuestionCategory()
    {
        $categories = QuestionCategory::all();
        return view('courseteacher.question.courseteacher_questioncategory', compact('categories'));

    }



    public function CourseTeacherQuestionChapter($categoryId)
    {
        $category = QuestionCategory::findOrFail($categoryId);
        // Fetch only the question chapters associated with the current course teacher's course
        $questionchapters = QuestionChapter::where('questioncategory_id', $categoryId)
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
        $user = Teacher::findOrFail($userId);

        // Retrieve the course ID associated with the user
        $courseId = $user->course_id;

        // Fetch the category based on the provided ID
        $category = QuestionCategory::findOrFail($id);

        // Create a new QuestionChapter instance
        $questionchapter = new QuestionChapter();
        $questionchapter->name = $validatedData['questionchapter'];
        $questionchapter->course_id = $courseId;
        $questionchapter->questioncategory_id = $category->id;

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


    public function editQuestionChapter($id)
    {
        $questionchapter = QuestionChapter::findOrFail($id);
        return view('courseteacher.question.courseteacher_edit_questionchapter', compact('questionchapter'));
    }

    public function updateQuestionChapter(Request $request, $id)
    {
        $request->validate([
            'questionchapter' => 'required|string|max:255',
        ]);

        $questionchapter = QuestionChapter::findOrFail($id);
        $questionchapter->name = $request->questionchapter;
        $questionchapter->save();

        $notification = [
            'message' => 'Question Chapter Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function deleteQuestionChapter($id)
    {
        $questionchapter = QuestionChapter::findOrFail($id);
        $questionCategoryId = $questionchapter->questioncategory_id;
        $questionchapter->delete();

        $notification = [
            'message' => 'Question Chapter Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


    public function CourseTeacherMcq($chapterId)
    {
        $questionchapter = QuestionChapter::findOrFail($chapterId);
        $mcqs = MCQ::where('questionchapter_id', $chapterId)->get();
        return view('courseteacher.question.courseteacher_mcq', compact('questionchapter', 'mcqs'));
    }

    public function CourseTeacherMcqAdd($id)
    {
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



    public function editMcqQuestion($id)
    {
        $mcq = MCQ::findOrFail($id);
        return view('courseteacher.question.courseteacher_edit_mcq', compact('mcq'));
    }

    public function updateMcqQuestion(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:a,b,c,d',
        ]);

        $mcq = MCQ::findOrFail($id);
        $mcq->update($validatedData);

        $notification = [
            'message' => 'MCQ Question Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('course.teacher.mcq', ['chapterId' => $mcq->questionchapter_id])->with($notification);
    }

    public function deleteMcqQuestion($id)
    {
        $mcq = MCQ::findOrFail($id);
        $questionChapterId = $mcq->questionchapter_id;
        $mcq->delete();

        $notification = [
            'message' => 'MCQ Question Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('course.teacher.mcq', ['chapterId' => $questionChapterId])->with($notification);
    }




    public function CourseTeacherBlooms($chapterId)
    {
        $questionchapter = QuestionChapter::findOrFail($chapterId);
        $questions = BLOOMS::where('questionchapter_id', $chapterId)->get()->groupBy('bloom_taxonomy');
        return view('courseteacher.question.courseteacher_blooms', compact('questionchapter', 'questions'));
    }


    public function CourseTeacherBloomsAdd($id)
    {
        $questionchapter = QuestionChapter::findOrFail($id);
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

    public function editBloomsQuestion($id)
    {
        $question = BLOOMS::findOrFail($id);
        return view('courseteacher.question.courseteacher_edit_blooms', compact('question'));
    }

    public function updateBloomsQuestion(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question_description' => 'required|string',
            'question_text' => 'required|string',
            'bloom_taxonomy' => 'required|string',
            'question_mark' => 'required|string',
        ]);

        $question = BLOOMS::findOrFail($id);
        $question->update($validatedData);

        $notification = [
            'message' => 'Bloom Question Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('course.teacher.blooms', ['chapterId' => $question->questionchapter_id])->with($notification);
    }

    public function deleteBloomsQuestion($id)
    {
        $question = BLOOMS::findOrFail($id);
        $questionChapterId = $question->questionchapter_id;
        $question->delete();

        $notification = [
            'message' => 'Bloom Question Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('course.teacher.blooms', ['chapterId' => $questionChapterId])->with($notification);
    }




    public function CourseTeacherExam()
    {
        // Retrieve the course ID associated with the authenticated user
        $courseId = auth()->user()->course_id;

        // Retrieve exams with their associated question chapters and question categories
        $exams = Exam::with('questionChapter', 'questionCategory')
            ->where('course_id', $courseId)
            ->get();

        // Pass the exams data to the view
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




    public function CourseTeacherStoreExam(Request $request)
    {
        // Get the course ID from the request
        $courseId = $request->input('course_id');
        // Get the question chapter ID from the request
        $questionChapterId = $request->input('questionchapter_id');

        // Validate the form data
        $validatedData = $request->validate([
            'exam_name' => 'required|string|max:255',
            'questioncategory_id' => 'required|exists:question_categories,id',
        ]);

        // Create a new exam instance
        $exam = new Exam();
        $exam->course_id = $courseId;
        $exam->questioncategory_id = $validatedData['questioncategory_id'];
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



    public function CourseTeacherMCQExam($chapterId)
    {
        $questionchapter = QuestionChapter::findOrFail($chapterId);
        $mcqs = MCQ::where('questionchapter_id', $chapterId)->get();
        return view('courseteacher.exam.courseteacher_mcq_exam', compact('questionchapter', 'mcqs'));
    }


    public function CourseTeacherBloomsExam($chapterId)
    {
        $questionchapter = QuestionChapter::findOrFail($chapterId);
        $questions = BLOOMS::where('questionchapter_id', $chapterId)->get()->groupBy('bloom_taxonomy');
        return view('courseteacher.exam.courseteacher_blooms_exam', compact('questionchapter', 'questions'));
    }




    public function editExam($id)
    {
        $exam = Exam::findOrFail($id);
        $questioncategories = QuestionCategory::all();
        $mcqQuestionChapters = QuestionChapter::where('questioncategory_id', 1)
            ->where('course_id', auth()->user()->course_id)
            ->get();
        $bloomsQuestionChapters = QuestionChapter::where('questioncategory_id', 2)
            ->where('course_id', auth()->user()->course_id)
            ->get();

        return view('courseteacher.exam.courseteacher_edit_exam', compact('exam', 'questioncategories', 'mcqQuestionChapters', 'bloomsQuestionChapters'));
    }

    public function updateExam(Request $request, $id)
    {
        $validatedData = $request->validate([
            'exam_name' => 'required|string|max:255',
            'questioncategory_id' => 'required|exists:question_categories,id',
            'questionchapter_id' => 'required|exists:question_chapters,id',
        ]);

        $exam = Exam::findOrFail($id);
        $exam->update($validatedData);

        $notification = [
            'message' => 'Exam updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('course.teacher.exam')->with($notification);
    }

    public function deleteExam($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

        $notification = [
            'message' => 'Exam deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('course.teacher.exam')->with($notification);
    }



    public function CourseTeacherExamCategory()
    {
        $exams = Exam::with('questionCategory')->get();

        return view('courseteacher.mark.courseteacher_student_exam_category', compact('exams'));
    }

    public function CourseTeacherStudentExamList($id)
    {
        $exam = Exam::with('questionCategory')->findOrFail($id);

        // Retrieve students associated with MCQ responses for the exam
        $mcqResponses = Mcqresponse::where('exam_id', $id)->pluck('student_id')->unique();
        $mcqStudents = Student::whereIn('id', $mcqResponses)->get();

        // Retrieve students associated with Blooms responses for the exam
        $bloomsResponses = Bloomsresponse::where('exam_id', $id)->pluck('student_id')->unique();
        $bloomsStudents = Student::whereIn('id', $bloomsResponses)->get();

        // Merge students from both types of responses
        $students = $mcqStudents->merge($bloomsStudents);

        return view('courseteacher.mark.courseteacher_exam_student_list', compact('exam', 'students'));
    }

    public function CourseTeacherMcqResponce($student_id, $exam_id)
    {
        $responses = Mcqresponse::where('student_id', $student_id)
            ->where('exam_id', $exam_id)
            ->with('mcq')
            ->get();

        return view('courseteacher.mark.courseteacher_mcq_responce', compact('responses'));
    }

    public function CourseTeacherBloomsResponce($student_id, $exam_id)
    {
        // Retrieve the responses along with the bloomsQuestion relationship
        $responses = Bloomsresponse::where('student_id', $student_id)
            ->where('exam_id', $exam_id)
            ->with('bloomsQuestion')
            ->get();

        $questionchapter = Exam::findOrFail($exam_id)->questionChapter;

        return view('courseteacher.mark.courseteacher_blooms_responce', compact('responses', 'questionchapter'));
    }

    public function CourseTeacherBloomsMarkUpdate(Request $request, $response_id)
    {
        // Validate the incoming request
        $request->validate([
            'marks' => 'required|string',
        ]);

        $response = Bloomsresponse::findOrFail($response_id);

        $response->update([
            'marks' => $request->marks,
        ]);

        return back()->with('success', 'Marks updated successfully');
    }



    public function CourseTeacherExamResult()
    {
        $teacher = auth()->user();

        // Retrieve the course associated with the teacher
        $course = Course::with('students')->find($teacher->course_id);

        // Check if the course exists
        if (!$course) {
            return redirect()->back()->with('error', 'No course assigned to this teacher.');
        }

        // Initialize arrays to store MCQ and Blooms scores
        $mcqScores = [];
        $bloomsScores = [];

        foreach ($course->students as $student) {
            $studentId = $student->id;

            // Get the current student's MCQ responses
            $mcqResponses = Mcqresponse::where('student_id', $studentId)
                ->with('exam', 'mcq', 'questionchapter', 'questioncategory')
                ->get();

            // Get the current student's Blooms responses
            $bloomsResponses = Bloomsresponse::where('student_id', $studentId)
                ->with('exam', 'bloomsQuestion', 'questionchapter', 'questioncategory')
                ->get();

            // Calculate total MCQ scores for each exam
            foreach ($mcqResponses as $response) {
                $examName = $response->exam->exam_name;
                $questionChapterName = $response->questionchapter->name;
                $questionCategoryName = $response->questioncategory->name;
                $studentName = $student->name;

                if (!isset($mcqScores[$examName][$studentName][$questionChapterName][$questionCategoryName])) {
                    $mcqScores[$examName][$studentName][$questionChapterName][$questionCategoryName] = 0;
                }

                $mcqScores[$examName][$studentName][$questionChapterName][$questionCategoryName] += $response->marks;
            }

            // Calculate Blooms exam scores grouped by taxonomy levels
            foreach ($bloomsResponses as $response) {
                $examName = $response->exam->exam_name;
                $questionChapterName = $response->questionchapter->name;
                $questionCategoryName = $response->questioncategory->name;
                $taxonomyLevel = $response->bloomsQuestion->bloom_taxonomy;
                $marks = $response->marks;
                $studentName = $student->name;

                // Initialize the taxonomy level if not already set
                if (!isset($bloomsScores[$examName][$studentName][$questionChapterName][$questionCategoryName][$taxonomyLevel])) {
                    $bloomsScores[$examName][$studentName][$questionChapterName][$questionCategoryName][$taxonomyLevel] = 0;
                }

                // Add marks to the corresponding taxonomy level
                $bloomsScores[$examName][$studentName][$questionChapterName][$questionCategoryName][$taxonomyLevel] += $marks;
            }
        }

        // Debugging line to inspect the structure of mcqScores and bloomsScores


        // Pass the MCQ and Blooms exam scores to the teacher exam result view
        return view('courseteacher.result.courseteacher_result', compact('mcqScores', 'bloomsScores'));
    }




}
