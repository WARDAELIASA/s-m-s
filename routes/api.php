<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('demo', DemoController::class);




// SCHOOL
// Route::get('/schools', [SchoolController::class, 'index']);
// Route::post('/add-school', [SchoolController::class, 'addSchool']);
// Route::put('/edit-school/{school}', [SchoolController::class, 'editSchool']);
// Route::delete('/delete-school/{school}', [SchoolController::class, 'deleteSchool']);
Route::resource('school', SchoolController::class);


// CLASS/LEVEL
Route::get('/levels', [LevelController::class, 'index']);
Route::post('/add-level', [LevelController::class, 'addLevel']);
Route::put('/edit-level/{level}', [LevelController::class, 'editLevel']);
Route::delete('/delete-level/{level}', [LevelController::class, 'deleteLevel']);

// STUDENTS
Route::get('/students', [StudentController::class, 'index']);
Route::post('/add-student', [StudentController::class, 'addStudent']);
Route::put('/edit-student/{student}', [StudentController::class, 'editstudent']);
Route::delete('/delete-student/{student}', [StudentController::class, 'deletestudent']);
