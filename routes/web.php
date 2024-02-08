<?php

use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ExamController;
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

Route::middleware('studentOrTeacher')->group(function () {
    Route::get('/discussion/{idSubject}', [DiscussionController::class, 'questions'])
        ->name('discussion.view');

    Route::post('/discussion/{idSubject}', [DiscussionController::class, 'storeQuestion']);
    Route::delete('/discussion/{id}', [DiscussionController::class, 'destroyQuestion']);
    Route::put('/discussion/{id}', [DiscussionController::class, 'updateQuestion']);
    Route::get('/discussion/{id}/detail', [DiscussionController::class, 'showQuestion']);

    Route::get('/discussion/{idQuestion}/reply', [DiscussionController::class, 'storeAnswer']);
    Route::delete('/discussion/reply/{id}', [DiscussionController::class, 'destroyAnswer']);
    Route::put('/discussion/reply/{id}', [DiscussionController::class, 'updateAnswer']);
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
    route::get('/teacher/materials/{id}/detail', [TeacherController::class, 'showMaterial']);
    route::put('/teacher/materials/{id}', [TeacherController::class, 'updateMaterial']);
    route::post('/teacher/materials/{idSubject}', [TeacherController::class, 'storeMaterial']);
    route::get('/teacher/materials/{id}/edit', [TeacherController::class, 'editMaterial']);
    route::delete('/teacher/materials/{idSubject}', [TeacherController::class, 'destroyMaterial']);

    route::get('/teacher/attachment/{id}', [TeacherController::class, 'attachments']);
    route::put('/teacher/attachment/score/{id}', [TeacherController::class, 'scoreAttachment']);

    route::get('/teacher/{idMaterial}/assignment/create', [TeacherController::class, 'createAssigment']);
    route::post('/teacher/assignment/{id}', [TeacherController::class, 'storeAssignment']);
    route::get('/teacher/assignment/{id}/edit', [TeacherController::class, 'editAssigment']);
    route::put('/teacher/assignment/{id}', [TeacherController::class, 'updateAssignment']);
    route::delete('/teacher/assignment/{id}', [TeacherController::class, 'destroyAssignment']);

    // upload image from CKEditor
    Route::post('/upload', [TeacherController::class, 'uploadImage'])->name('ckeditor.upload');
    Route::post('/delete-ckeditor-image', [TeacherController::class, 'deleteCkeditorImage'])->name('ckeditor.deleteCkeditorImage');

    Route::get('/teacher/exam/{idSubject}', [ExamController::class, 'exams']);
    Route::post('/teacher/exam/{idSubject}', [ExamController::class, 'storeExam']);
    Route::delete('/teacher/exam/{id}', [ExamController::class, 'destroyExam']);
    Route::put('/teacher/exam/{id}/update-status', [ExamController::class, 'updateStatus']);
    Route::put('/teacher/exam/{id}', [ExamController::class, 'updateExam']);
    Route::get('/teacher/{idExam}/question/create', [ExamController::class, 'createQuestion']);
    Route::post('/teacher/question/{idExam}', [ExamController::class, 'storeQuestion']);
    Route::post('/teacher/option/{idQuestion}', [ExamController::class, 'storeOption']);
});

Route::middleware('student')->group(function () {
    Route::get('/student/subject', [StudentController::class, 'subjects'])->name('subjects');

    Route::get('/student/profile/{id}/edit', [StudentController::class, 'editProfile']);
    Route::put('/student/profile/{id}', [StudentController::class, 'updateProfile']);
    Route::get('/student/profile/{id}', [StudentController::class, 'profile']);

    Route::post('/student/enroll/{enrollmentKey}', [StudentController::class, 'enrollSubject'])->name('student.enroll');

    Route::get('student/materials/{id}', [StudentController::class, 'materials'])->name('learning-page');
    Route::post('student/materials/{id}', [StudentController::class, 'storeAssignment']);

    Route::get('/student/{idMaterial}/submission/create', [StudentController::class, 'createSubmission']);
    Route::post('/student/submission/{id}', [StudentController::class, 'storeSubmission']);
    Route::get('/student/submission/{id}/edit', [StudentController::class, 'editSubmission']);
    Route::put('/student/submission/{id}', [StudentController::class, 'updateSubmission']);
    Route::delete('/student/submission/{id}', [StudentController::class, 'destroySubmission']);

    Route::get('/student/exam/{idSubject}', [ExamController::class, 'ExamStudent']);
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
