<?php

use App\Http\Controllers\CourseTeacherController;
use App\Http\Controllers\ProfileController;
use App\Models\Questioncreator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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
    });
});


Route::get('course-teacher/login', [AuthenticatedSessionController::class, 'QuestionCreatorLogin'])->name('questioncreator.login');
Route::post('course-teacher/login', [AuthenticatedSessionController::class, 'store']);


Route::get('course-teacher/register', [RegisteredUserController::class, 'QuestionCreatorRegister'])->name('questioncreator.register');
Route::post('course-teacher/register', [RegisteredUserController::class, 'QuestionCreatorRegisterStore']);


