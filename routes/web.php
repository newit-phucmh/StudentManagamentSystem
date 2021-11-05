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


Route::get('/test',[App\Http\Controllers\UserController::class,'test']);

Route::post('/auth/save',[AuthenticationController::class, 'save'])->name('auth.save');
Route::post('/auth/check',[AuthenticationController::class, 'check'])->name('auth.check');
Route::get('/auth/logout',[AuthenticationController::class, 'logout'])->name('auth.logout');




Route::group(['middleware'=>['AuthCheck']], function(){
    Route::get('/auth/login',[AuthenticationController::class, 'login'])->name('auth.login');
    Route::get('/auth/register',[AuthenticationController::class, 'register'])->name('auth.register');

    Route::get('/admin/dashboard',[AuthenticationController::class, 'dashboard']);
    Route::get('/admin/settings',[AuthenticationController::class,'settings']);
    Route::get('/admin/profile',[AuthenticationController::class,'profile']);
    Route::get('/admin/staff',[AuthenticationController::class,'staff']);

    Route::get('admin/', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('admin/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::get('admin/show/{id}', [App\Http\Controllers\UserController::class, 'show']);
    Route::get('admin/create', [App\Http\Controllers\UserController::class, 'create']);
    Route::post('admin/store', [App\Http\Controllers\UserController::class, 'store']);
    Route::post('admin/update/{id}', [App\Http\Controllers\UserController::class, 'update']);
    Route::get('admin/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy']);

    Route::get('admin/class', [App\Http\Controllers\ClassController::class, 'index']);
    Route::get('admin/class/edit/{id}', [App\Http\Controllers\ClassController::class, 'edit']);
    Route::get('admin/class/show/{id}', [App\Http\Controllers\ClassController::class, 'show']);
    Route::get('admin/class/create', [App\Http\Controllers\ClassController::class, 'create']);
    Route::post('admin/class/store', [App\Http\Controllers\ClassController::class, 'store']);
    Route::post('admin/class/update/{id}', [App\Http\Controllers\ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [App\Http\Controllers\ClassController::class, 'destroy']);
});
