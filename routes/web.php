<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;

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
