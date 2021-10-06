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

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Courses
    Route::resource('courses', CourseController::class);

    // Students
    Route::resource('students', StudentController::class);

    // Grades
    Route::prefix('grades')->name('grades.')->group(function() {
        Route::get('/', [GradeController::class, 'index'])->name('index');
        Route::get('upload', [GradeController::class, 'upload'])->name('upload');
        Route::post('import', [GradeController::class, 'import'])->name('import');
        Route::delete('{grade}', [GradeController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';
