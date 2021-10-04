<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Courses
Route::resource('courses', CourseController::class);

// Students
Route::resource('students', StudentController::class);

// Grades
Route::get('grades/upload', [GradeController::class, 'upload'])->name('grades.upload');
Route::post('grades/import', [GradeController::class, 'import'])->name('grades.import');
Route::resource('grades', GradeController::class);

require __DIR__.'/auth.php';
