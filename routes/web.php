<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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

Route::get('/registration',[LoginController::class,'registration']);
Route::post('register-user',[LoginController::class,'registerUser'])->name('register-user');

Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/login',[LoginController::class,'loginSubmit'])->name('login');

Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/admin/dash', [AdminController::class,'adminDash'])->name('adminDash')->middleware('ValidAdmin'); 

Route::get('/home', [AdminController::class, 'adminDash'])->name('home')->middleware('ValidAdmin');

//Student Routes
Route::get('/studentList',[StudentController::class, 'studentList'])->name('studentList')->middleware('ValidAdmin');
Route::get('/studentEdit/{id}',[StudentController::class, 'studentEdit'])->name('studentEdit');
Route::post('/studentEdit',[StudentController::class, 'studentEditSubmitted'])->name('studentEdit');
Route::get('/studentDelete/{id}',[StudentController::class, 'studentDelete'])->name('studentDelete');
Route::get('/studentCreate',[StudentController::class, 'studentCreate'])->name('studentCreate')->middleware('ValidAdmin');
Route::post('/studentCreate',[StudentController::class, 'studentCreateSubmitted'])->name('studentCreateSubmitted');

Route::get('RunSearch',[StudentController::class,'RunSearch'])->name('RunSearch');
Route::get('search',[StudentController::class,'search'])->name('search');
