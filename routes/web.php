<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuestionCreatorController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\QuestionCreatorMiddleware;
use App\Http\Middleware\UserMiddleware;


use Illuminate\Support\Facades\Route;

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
})->middleware([UserMiddleware::class])->name('dashboard');

Route::middleware([AdminMiddleware::class])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::middleware([AdminMiddleware::class])->group(function () {

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/Profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/Profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');


    Route::get('/admin/course', [AdminController::class, 'AdminCourse'])->name('admin.course');
    Route::get('/admin/create-course', [AdminController::class, 'AdminCourseCreate'])->name('admin.course.create');
    Route::post('/admin/course-store', [AdminController::class, 'AdminCourseStore'])->name('admin.course.store');

   
});  // End Admin group middleware




Route::middleware([QuestionCreatorMiddleware::class])->group(function () {



   
});  // End Admin group middleware



// admin login
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

// question creator login and register
Route::get('/question-creator/login', [QuestionCreatorController::class, 'QuestionCreatorLogin'])->name('questioncreator.login');
Route::get('/question-creator/register', [QuestionCreatorController::class, 'QuestionCreatorRegister'])->name('questioncreator.register');

// course teacher login and register
// Route::get('/course-teacher/login', [Questioncreator::class, 'CourseTeacherLogin'])->name('.login');
// Route::get('/course-teacher/register', [Questioncreator::class, 'CourseTeacherRegister'])->name('questioncreator.register');