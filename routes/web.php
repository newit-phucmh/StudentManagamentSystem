<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

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


Route::get('/test',[App\Http\Controllers\ClassController::class,'getCourse']);
Route::get('/test/{id}',[App\Http\Controllers\UserController::class,'getClass']);

Route::post('/auth/save',[AuthenticationController::class, 'save'])->name('auth.save');
Route::post('/auth/check',[AuthenticationController::class, 'check'])->name('auth.check');
Route::get('/auth/logout',[AuthenticationController::class, 'logout'])->name('auth.logout');
Route::get('admin/export', [App\Http\Controllers\CheckinController::class, 'export']);




Route::group(['middleware'=>['AuthCheck']], function(){
    Route::get('/auth/login',[AuthenticationController::class, 'login'])->name('auth.login');
    Route::get('/auth/register',[AuthenticationController::class, 'register'])->name('auth.register');

    Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'index']);

    Route::get('admin/student', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('admin/student/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::get('admin/student/show/{id}', [App\Http\Controllers\UserController::class, 'show']);
    Route::get('admin/student/create', [App\Http\Controllers\UserController::class, 'create']);
    Route::post('admin/student/store', [App\Http\Controllers\UserController::class, 'store']);
    Route::post('admin/student/update/{id}', [App\Http\Controllers\UserController::class, 'update']);
    Route::get('admin/student/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy']);

    Route::get('admin/class', [App\Http\Controllers\ClassController::class, 'index']);
    Route::get('admin/class/edit/{id}', [App\Http\Controllers\ClassController::class, 'edit']);
    Route::get('admin/class/show/{id}', [App\Http\Controllers\ClassController::class, 'show']);
    Route::get('admin/class/create', [App\Http\Controllers\ClassController::class, 'create']);
    Route::post('admin/class/store', [App\Http\Controllers\ClassController::class, 'store']);
    Route::post('admin/class/update/{id}', [App\Http\Controllers\ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [App\Http\Controllers\ClassController::class, 'destroy']);

    Route::get('admin/course', [App\Http\Controllers\CourseController::class, 'index']);
    Route::get('admin/course/edit/{id}', [App\Http\Controllers\CourseController::class, 'edit']);
    Route::get('admin/course/show/{id}', [App\Http\Controllers\CourseController::class, 'show']);
    Route::get('admin/course/create', [App\Http\Controllers\CourseController::class, 'create']);
    Route::post('admin/course/store', [App\Http\Controllers\CourseController::class, 'store']);
    Route::post('admin/course/update/{id}', [App\Http\Controllers\CourseController::class, 'update']);
    Route::get('admin/course/delete/{id}', [App\Http\Controllers\CourseController::class, 'destroy']);

    Route::get('admin/checkin', [App\Http\Controllers\CheckinController::class, 'index']);
});
