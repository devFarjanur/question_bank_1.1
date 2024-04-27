<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;




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



Route::middleware('admin')->group(function () {


    Route::get('/admin/course', [AdminController::class, 'AdminCourse'])->name('admin.course');

   
});  // End Admin group middleware


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

