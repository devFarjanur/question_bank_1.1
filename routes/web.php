<?php

use App\Http\Controllers\CourseTeacherController;
use App\Http\Controllers\ProfileController;
use App\Models\Questioncreator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController; // Import the RegisteredUserController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('guest')->group(function () { // Group routes that should only be accessible to guests
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register'); // Define the register route
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware('auth')
    ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['auth', 'signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');

        Route::put('/user/password', [NewPasswordController::class, 'update'])
        ->name('password.update');


    Route::prefix('user')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

Route::middleware('auth:admin')->group(function () {
    Route::prefix('admin')->group(function () {

        Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
        Route::get('/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
        Route::post('/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
        Route::get('/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
        Route::post('/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
        Route::get('/course', [AdminController::class, 'AdminCourse'])->name('admin.course');
        Route::get('/create-course', [AdminController::class, 'AdminCourseCreate'])->name('admin.course.create');
        Route::post('/course-store', [AdminController::class, 'AdminCourseStore'])->name('admin.course.store');


        Route::get('/course-teacher', [AdminController::class, 'AdminCourseTeacher'])->name('admin.course.teacher');
        Route::put('/course-teacher/{id}/approve', [AdminController::class, 'AdminApproveCourseTeacher'])->name('admin.approve.course.teacher');


        Route::get('/course-student', [AdminController::class, 'AdminCourseStudent'])->name('admin.course.student');
        Route::put('/course-student/{id}/approve', [AdminController::class, 'AdminApproveCourseStudent'])->name('admin.approve.course.student');


        Route::get('/admin/questioncategory', [AdminController::class, 'AdminQuestionCategory'])->name('admin.question.category');
        Route::get('/admin/questioncategory/create', [AdminController::class, 'AdminQuestionCategoryCreate'])->name('admin.question.category.create');
        Route::post('/admin/questioncategory/store', [AdminController::class, 'AdminQuestionCategoryStore'])->name('admin.question.category.store');


        
    



    });
});

Route::get('admin/login', [AuthenticatedSessionController::class, 'CreateAdminForm'])->name('admin.login');

Route::post('admin/login', [AuthenticatedSessionController::class, 'store']);  


Route::middleware('auth:questioncreator')->group(function () {
    Route::prefix('course-teacher')->group(function () {


        Route::get('/logout', [CourseTeacherController::class, 'CourseTeacherLogout'])->name('course.teacher.logout');
        Route::get('/profile', [CourseTeacherController::class, 'CourseTeacherProfile'])->name('course.teacher.profile');
        Route::post('/profile/store', [CourseTeacherController::class, 'CourseTeacherProfileStore'])->name('course.teacher.profile.store');
        Route::get('/change/password', [CourseTeacherController::class, 'CourseTeacherChangePassword'])->name('course.teacher.change.password');
        Route::post('/update/password', [CourseTeacherController::class, 'CourseTeacherUpdatePassword'])->name('course.teacher.update.password');


        Route::get('/course', [CourseTeacherController::class, 'CourseTeacherCourse'])->name('course.teacher.course');
        Route::get('/question', [CourseTeacherController::class, 'CourseTeacherQuestion'])->name('course.teacher.question');

        Route::get('/question-category', [CourseTeacherController::class, 'CourseTeacherQuestionCategory'])->name('course.teacher.question.category');


        Route::get('/question-chapter/{id}', [CourseTeacherController::class, 'CourseTeacherQuestionChapter'])->name('course.teacher.question.chapter');
        Route::get('/question-chapter/add/{id}', [CourseTeacherController::class, 'CourseTeacherQuestionChapterAdd'])->name('course.teacher.question.add.chapter');
        Route::post('/question-chapter/store/{id}', [CourseTeacherController::class, 'CourseTeacherQuestionChapterStore'])->name('course.teacher.question.chapter.store');


        Route::get('/mcq-question/{chapterId}', [CourseTeacherController::class, 'CourseTeacherMcq'])->name('course.teacher.mcq');
        Route::get('/mcq-question/add/{id}', [CourseTeacherController::class, 'CourseTeacherMcqAdd'])->name('course.teacher.mcq.add');
        Route::post('/mcq-question/store/{id}', [CourseTeacherController::class, 'CourseTeacherMcqStore'])->name('course.teacher.mcq.store');

        Route::get('/blooms-question/{chapterId}', [CourseTeacherController::class, 'CourseTeacherBlooms'])->name('course.teacher.blooms');
        Route::get('/blooms-question/add/{id}', [CourseTeacherController::class, 'CourseTeacherBloomsAdd'])->name('course.teacher.blooms.add');
        Route::post('/blooms-question/store/{id}', [CourseTeacherController::class, 'CourseTeacherBloomsStore'])->name('course.teacher.blooms.store');


        // Route to show the exam creation form

        Route::get('/exam', [CourseTeacherController::class, 'CourseTeacherExam'])->name('course.teacher.exam');
        Route::get('/exam/create', [CourseTeacherController::class, 'CourseTeacherCreateExam'])->name('course.teacher.exam.create');
        Route::post('/exam/store', [CourseTeacherController::class, 'CourseTeacherStoreExam'])->name('course.teacher.exam.store');


        Route::get('/mcq-exam/{chapterId}', [CourseTeacherController::class, 'CourseTeacherMcqExam'])->name('course.teacher.mcq.exam');
        Route::get('/blooms-exam/{chapterId}', [CourseTeacherController::class, 'CourseTeacherBloomsExam'])->name('course.teacher.blooms.exam');



    });
});


Route::get('course-teacher/login', [AuthenticatedSessionController::class, 'QuestionCreatorLogin'])->name('questioncreator.login');
Route::post('course-teacher/login', [AuthenticatedSessionController::class, 'store']);


Route::get('course-teacher/register', [RegisteredUserController::class, 'QuestionCreatorRegister'])->name('questioncreator.register');
Route::post('course-teacher/register', [RegisteredUserController::class, 'QuestionCreatorRegisterStore']);


Route::middleware('auth:student')->group(function () {
    Route::prefix('student')->group(function () {

        Route::get('/logout', [StudentController::class, 'StudentLogout'])->name('student.logout');
        Route::get('/profile', [StudentController::class, 'StudentProfile'])->name('student.profile');
        Route::post('/profile/store', [StudentController::class, 'StudentProfileStore'])->name('student.profile.store');
        Route::get('/change/password', [StudentController::class, 'StudentChangePassword'])->name('student.change.password');
        Route::post('/update/password', [StudentController::class, 'StudentUpdatePassword'])->name('student.update.password');


        Route::get('/course', [StudentController::class, 'StudentCourse'])->name('student.course');
        Route::get('/exam', [StudentController::class, 'StudentExam'])->name('student.exam');


        Route::get('/submit-mcq-response/{exam_id}', [StudentController::class, 'StudentMcqExam'])->name('student.mcq.exam');

        Route::get('/submit-blooms-response/{exam_id}', [StudentController::class, 'StudentBloomsExam'])->name('student.blooms.exam');




    });
});


Route::get('student/login', [AuthenticatedSessionController::class, 'StudentLogin'])->name('student.login');
Route::post('student/login', [AuthenticatedSessionController::class, 'store']);



Route::get('student/register', [RegisteredUserController::class, 'StudentRegister'])->name('student.register');
Route::post('student/register', [RegisteredUserController::class, 'StudentRegisterStore']);
