<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

use App\Http\Middleware\AdminMiddleware;


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
})->middleware('user')->name('dashboard');

Route::middleware('user')->group(function () {

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


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

