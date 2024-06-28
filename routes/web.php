<?php

use App\Http\Controllers\CourseTeacherController;
use App\Http\Controllers\LandingPageController;
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

// Route::get('/', function () {
//     return view('student.login');
// });


Route::get('/home', [LandingPageController::class, 'home'])->name('home');

Route::get('/course', function () {
    return view('main.course');
})->name('course');

Route::get('/about', function () {
    return view('main.about');
})->name('about');

Route::get('/contact', function () {
    return view('main.contact');
})->name('contact');






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


        Route::get('/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');


        Route::delete('/teacher/{id}', [AdminController::class, 'deleteTeacher'])->name('admin.teacher.delete');
        Route::delete('/student/{id}', [AdminController::class, 'deleteStudent'])->name('admin.student.delete');



        Route::get('/course', [AdminController::class, 'AdminCourse'])->name('admin.course');
        Route::get('/create-course', [AdminController::class, 'AdminCourseCreate'])->name('admin.course.create');
        Route::post('/course-store', [AdminController::class, 'AdminCourseStore'])->name('admin.course.store');

        Route::get('/course/edit/{id}', [AdminController::class, 'editCourse'])->name('admin.course.edit');
        Route::post('/course/update/{id}', [AdminController::class, 'updateCourse'])->name('admin.course.update');
        Route::delete('/course/delete/{id}', [AdminController::class, 'deleteCourse'])->name('admin.course.delete');



        Route::get('/teacher', [AdminController::class, 'AdminCourseTeacher'])->name('admin.course.teacher');
        Route::put('/teacher/{id}/approve', [AdminController::class, 'AdminApproveCourseTeacher'])->name('admin.approve.course.teacher');
        Route::delete('/teacher/{id}/reject', [AdminController::class, 'rejectCourseTeacher'])->name('admin.reject.course.teacher');


        Route::get('/student', [AdminController::class, 'AdminCourseStudent'])->name('admin.course.student');
        Route::put('/student/{id}/approve', [AdminController::class, 'AdminApproveCourseStudent'])->name('admin.approve.course.student');
        Route::delete('/student/{id}/reject', [AdminController::class, 'rejectCourseStudent'])->name('admin.reject.course.student');


        Route::get('/questioncategory', [AdminController::class, 'AdminQuestionCategory'])->name('admin.question.category');
        Route::get('/questioncategory/create', [AdminController::class, 'AdminQuestionCategoryCreate'])->name('admin.question.category.create');
        Route::post('/questioncategory/store', [AdminController::class, 'AdminQuestionCategoryStore'])->name('admin.question.category.store');


        Route::get('/questioncategory/edit/{id}', [AdminController::class, 'editQuestionCategory'])->name('admin.question.category.edit');
        Route::post('/questioncategory/update/{id}', [AdminController::class, 'updateQuestionCategory'])->name('admin.question.category.update');
        Route::delete('/questioncategory/delete/{id}', [AdminController::class, 'deleteQuestionCategory'])->name('admin.question.category.delete');








    });
});

Route::get('admin/login', [AuthenticatedSessionController::class, 'CreateAdminForm'])->name('admin.login');

Route::post('admin/login', [AuthenticatedSessionController::class, 'store']);






Route::middleware('auth:questioncreator')->group(function () {
    Route::prefix('teacher')->group(function () {
        Route::get('/logout', [CourseTeacherController::class, 'CourseTeacherLogout'])->name('course.teacher.logout');
        Route::get('/profile', [CourseTeacherController::class, 'CourseTeacherProfile'])->name('course.teacher.profile');
        Route::post('/profile/store', [CourseTeacherController::class, 'CourseTeacherProfileStore'])->name('course.teacher.profile.store');
        Route::get('/change/password', [CourseTeacherController::class, 'CourseTeacherChangePassword'])->name('course.teacher.change.password');
        Route::post('/update/password', [CourseTeacherController::class, 'CourseTeacherUpdatePassword'])->name('course.teacher.update.password');

        Route::get('/dashboard', [CourseTeacherController::class, 'CourseTeacherCourse'])->name('course.teacher.course');

        Route::get('/lesson', [CourseTeacherController::class, 'CourseTeacherLesson'])->name('course.teacher.lesson');
        Route::get('/lesson/create/{course}', [CourseTeacherController::class, 'createLesson'])->name('course.teacher.lesson.create');
        Route::post('/lesson/store/{course}', [CourseTeacherController::class, 'storeLesson'])->name('course.teacher.lesson.store');
        Route::get('/lesson/show/{lesson}', [CourseTeacherController::class, 'showLesson'])->name('course.teacher.lesson.show');
        Route::get('/lesson/edit/{lesson}', [CourseTeacherController::class, 'editLesson'])->name('course.teacher.lesson.edit');
        Route::post('/lesson/update/{lesson}', [CourseTeacherController::class, 'updateLesson'])->name('course.teacher.lesson.update');
        Route::delete('/lesson/delete/{lesson}', [CourseTeacherController::class, 'deleteLesson'])->name('course.teacher.lesson.delete');

        Route::get('/question', [CourseTeacherController::class, 'CourseTeacherQuestion'])->name('course.teacher.question');
        Route::get('/question-category', [CourseTeacherController::class, 'CourseTeacherQuestionCategory'])->name('course.teacher.question.category');
        Route::get('/question-chapter/{id}', [CourseTeacherController::class, 'CourseTeacherQuestionChapter'])->name('course.teacher.question.chapter');
        Route::get('/question-chapter/add/{id}', [CourseTeacherController::class, 'CourseTeacherQuestionChapterAdd'])->name('course.teacher.question.add.chapter');
        Route::post('/question-chapter/store/{id}', [CourseTeacherController::class, 'CourseTeacherQuestionChapterStore'])->name('course.teacher.question.chapter.store');
        Route::get('/question-chapter/edit/{id}', [CourseTeacherController::class, 'editQuestionChapter'])->name('course.teacher.question.chapter.edit');
        Route::post('/question-chapter/update/{id}', [CourseTeacherController::class, 'updateQuestionChapter'])->name('course.teacher.question.chapter.update');
        Route::delete('/question-chapter/delete/{id}', [CourseTeacherController::class, 'deleteQuestionChapter'])->name('course.teacher.question.chapter.delete');

        Route::get('/mcq-question/{chapterId}', [CourseTeacherController::class, 'CourseTeacherMcq'])->name('course.teacher.mcq');
        Route::get('/mcq-question/add/{id}', [CourseTeacherController::class, 'CourseTeacherMcqAdd'])->name('course.teacher.mcq.add');
        Route::post('/mcq-question/store/{id}', [CourseTeacherController::class, 'CourseTeacherMcqStore'])->name('course.teacher.mcq.store');
        Route::get('/mcq-question/edit/{id}', [CourseTeacherController::class, 'editMcqQuestion'])->name('course.teacher.mcq.edit');
        Route::post('/mcq-question/update/{id}', [CourseTeacherController::class, 'updateMcqQuestion'])->name('course.teacher.mcq.update');
        Route::delete('/mcq-question/delete/{id}', [CourseTeacherController::class, 'deleteMcqQuestion'])->name('course.teacher.mcq.delete');

        Route::get('/blooms-question/{chapterId}', [CourseTeacherController::class, 'CourseTeacherBlooms'])->name('course.teacher.blooms');
        Route::get('/blooms-question/add/{id}', [CourseTeacherController::class, 'CourseTeacherBloomsAdd'])->name('course.teacher.blooms.add');
        Route::post('/blooms-question/store/{id}', [CourseTeacherController::class, 'CourseTeacherBloomsStore'])->name('course.teacher.blooms.store');
        Route::get('/blooms-question/edit/{id}', [CourseTeacherController::class, 'editBloomsQuestion'])->name('course.teacher.blooms.edit');
        Route::post('/blooms-question/update/{id}', [CourseTeacherController::class, 'updateBloomsQuestion'])->name('course.teacher.blooms.update');
        Route::delete('/blooms-question/delete/{id}', [CourseTeacherController::class, 'deleteBloomsQuestion'])->name('course.teacher.blooms.delete');

        Route::get('/exam', [CourseTeacherController::class, 'CourseTeacherExam'])->name('course.teacher.exam');
        Route::get('/exam/create', [CourseTeacherController::class, 'CourseTeacherCreateExam'])->name('course.teacher.exam.create');
        Route::post('/exam/store', [CourseTeacherController::class, 'CourseTeacherStoreExam'])->name('course.teacher.exam.store');
        Route::get('/exam/edit/{id}', [CourseTeacherController::class, 'editExam'])->name('course.teacher.exam.edit');
        Route::post('/exam/update/{id}', [CourseTeacherController::class, 'updateExam'])->name('course.teacher.exam.update');
        Route::delete('/exam/delete/{id}', [CourseTeacherController::class, 'deleteExam'])->name('course.teacher.exam.delete');

        Route::get('/mcq-exam/{chapterId}', [CourseTeacherController::class, 'CourseTeacherMcqExam'])->name('course.teacher.mcq.exam');
        Route::get('/blooms-exam/{chapterId}', [CourseTeacherController::class, 'CourseTeacherBloomsExam'])->name('course.teacher.blooms.exam');
        Route::get('/exam-category', [CourseTeacherController::class, 'CourseTeacherExamCategory'])->name('course.teacher.exam.category');
        Route::get('/student-exam/{id}', [CourseTeacherController::class, 'CourseTeacherStudentExamList'])->name('course.teacher.student.exam.list');

        Route::get('/mcq/response/{student_id}/{exam_id}', [CourseTeacherController::class, 'CourseTeacherMcqResponce'])->name('course.teacher.mcq.response');
        Route::get('/blooms/response/{student_id}/{exam_id}', [CourseTeacherController::class, 'CourseTeacherBloomsResponce'])->name('course.teacher.blooms.response');
        Route::put('/blooms/update-marks/{response_id}', [CourseTeacherController::class, 'CourseTeacherBloomsMarkUpdate'])->name('course.teacher.blooms.mark.update');
    });
});


Route::get('teacher/login', [AuthenticatedSessionController::class, 'QuestionCreatorLogin'])->name('questioncreator.login');
Route::post('teacher/login', [AuthenticatedSessionController::class, 'store']);


Route::get('teacher/register', [RegisteredUserController::class, 'QuestionCreatorRegister'])->name('questioncreator.register');
Route::post('teacher/register', [RegisteredUserController::class, 'QuestionCreatorRegisterStore']);





Route::middleware('auth:student')->group(function () {
    Route::prefix('student')->group(function () {
        Route::get('/logout', [StudentController::class, 'StudentLogout'])->name('student.logout');
        Route::get('/profile', [StudentController::class, 'StudentProfile'])->name('student.profile');
        Route::post('/profile/store', [StudentController::class, 'StudentProfileStore'])->name('student.profile.store');
        Route::get('/change/password', [StudentController::class, 'StudentChangePassword'])->name('student.change.password');
        Route::post('/update/password', [StudentController::class, 'StudentUpdatePassword'])->name('student.update.password');

        Route::get('/course', [StudentController::class, 'CourseStudentLesson'])->name('student.course');
        Route::get('/lesson/show/{lesson}', [StudentController::class, 'studentshowLesson'])->name('course.student.lesson');
        Route::post('/lesson/{lesson}/complete', [StudentController::class, 'markAsComplete'])->name('lesson.complete');

        Route::get('/exam', [StudentController::class, 'StudentExam'])->name('student.exam');
        Route::get('/mcq/{id}', [StudentController::class, 'StudentMcqExam'])->name('student.mcq.exam');
        Route::post('/mcq-submit/{id}', [StudentController::class, 'StudentMcqExamSubmit'])->name('student.mcq.exam.submit');
        Route::get('/blooms/{id}', [StudentController::class, 'StudentBloomsExam'])->name('student.blooms.exam');
        Route::post('/blooms-submit/{id}', [StudentController::class, 'StudentBloomsExamSubmit'])->name('student.blooms.exam.submit');
        Route::get('/result', [StudentController::class, 'StudentExamResult'])->name('student.exam.result');
    });
});


Route::get('/', [AuthenticatedSessionController::class, 'StudentLogin'])->name('student.login');
Route::post('/', [AuthenticatedSessionController::class, 'store']);



Route::get('/register', [RegisteredUserController::class, 'StudentRegister'])->name('student.register');
Route::post('/register', [RegisteredUserController::class, 'StudentRegisterStore']);
