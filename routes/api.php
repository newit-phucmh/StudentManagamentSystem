<?php

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CheckinController;
use App\Models\User;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>['auth:api']], function(){
    Route::get('/student', [ClassController::class, 'getUser']);
    Route::post('/student/checkin', [CheckinController::class, 'checkin']);
    Route::get('/student/profile', [ClassController::class, 'get']);
});




Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);  
    Route::post('/logout', [UserController::class, 'logout']);
});

