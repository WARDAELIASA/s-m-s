<?php

use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolController;
use App\Models\School;
use App\Models\student;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// USER
Route::get('/users', [UserController::class, 'index'])->name('users');

// SCHOOL
Route::get('/schools', [SchoolController::class, 'index'])->name('schools.index');
Route::post('/add-school', [SchoolController::class, 'addSchool'])->name('schools.add');
Route::put('/edit-school/{school}', [SchoolController::class, 'editSchool'])->name('schools.edit');
Route::delete('/delete-school/{school}', [SchoolController::class, 'deleteSchool'])->name('schools.delete');
Route::GET('/school-level/{school}', [SchoolController::class, 'shoeLevel'])->name('school.level');

// CLASS/LEVEL
Route::get('/levels', [LevelController::class, 'index'])->name('levels.index');
Route::post('/add-level', [LevelController::class, 'addLevel'])->name('levels.add');
Route::put('/edit-level/{level}', [LevelController::class, 'editLevel'])->name('levels.edit');
Route::delete('/delete-level/{level}', [LevelController::class, 'deleteLevel'])->name('levels.delete');
Route::GET('/level-level/{level}', [LevelController::class, 'shoeLevel'])->name('level.level');



// STUDENTS
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::post('/add-student', [StudentController::class, 'addStudent'])->name('student.add');
Route::put('/edit-student/{student}', [StudentController::class, 'editstudent'])->name('student.edit');
Route::delete('/delete-student/{student}', [StudentController::class, 'deletestudent'])->name('student.delete');
Route::GET('/level-level/{level}', [LevelController::class, 'shoeLevel'])->name('student.student');
