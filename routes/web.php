<?php

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;

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
    return view('index');
});
Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard']);
    Route::get('/admin/teacher', [AdminController::class, 'teachers']);
    Route::get('/admin/teacher/create', [AdminController::class, 'createTeachers']);
    Route::post('/admin/teacher', [AdminController::class, 'storeTeacher']);
    Route::delete('/admin/teacher/{id}', [AdminController::class, 'destroyTeacher'])->name('teacher.destroy');

    Route::get('/admin/student', [AdminController::class, 'student']);
    Route::delete('/admin/student/{id}', [AdminController::class, 'destroyStudent'])->name('student.destroy');

    Route::resource('/admin/subject', SubjectController::class);
});

Route::middleware('teacher')->group(function () {
    Route::get('/teacher', [TeacherController::class, 'dashboard']);
    Route::get('/teacher/subject', [TeacherController::class, 'subjects']);
    Route::get('/teacher/subject/{id}/student', [TeacherController::class, 'students']);
    Route::put('/teacher/subject/{id}', [TeacherController::class, 'settingSubject']);

    route::get('/teacher/profile/{id}/edit', [TeacherController::class, 'editProfile']);
    route::put('/teacher/profile/{id}', [TeacherController::class, 'updateProfile']);
    route::get('/teacher/profile/{id}', [TeacherController::class, 'profile']);

    route::get('/teacher/materials/create/{idSubject}', [TeacherController::class, 'createMaterial']);
    route::get('/teacher/materials/{id}', [TeacherController::class, 'materials']);
    route::put('/teacher/materials/{idSubject}', [TeacherController::class, 'updateMaterial']);
    route::post('/teacher/materials/{idSubject}', [TeacherController::class, 'storeMaterial']);
    route::get('/teacher/materials/{id}/edit', [TeacherController::class, 'editMaterial']);
    route::get('/teacher/materials/{id}/detail', [TeacherController::class, 'showMaterial']);
    route::delete('/teacher/materials/{idSubject}', [TeacherController::class, 'destroyMaterial']);
});

Route::middleware('student')->group(function () {
    Route::get('/student/subject', [StudentController::class, 'subjects']);

    route::get('/student/profile/{id}/edit', [StudentController::class, 'editProfile']);
    route::put('/student/profile/{id}', [StudentController::class, 'updateProfile']);
    route::get('/student/profile/{id}', [StudentController::class, 'profile']);

    Route::post('/student/enroll/{enrollmentKey}', [StudentController::class, 'enrollSubject'])->name('student.enroll');
});

Route::get('/login', [LoginController::class, 'login']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/login/verify', [LoginController::class, 'verify'])->name('verification.verify');

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/register/{key}', [RegisterController::class, 'verify'])->name('verify');

Route::get('/forgot', [ResetPasswordController::class, 'forgot_password']);
Route::post('/forgot', [ResetPasswordController::class, 'store']);
Route::get('/reset/{token}', [ResetPasswordController::class, 'verify'])->name('verify');
Route::post('/reset', [ResetPasswordController::class, 'reset']);
