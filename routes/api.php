<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\API\StationController;
use App\Http\Controllers\API\MessageController;

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

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});


// admin routes
Route::get('/admin/home', [HomeController::class, 'getUsers'])->middleware('admin');
Route::get('/admin/home/clearStudent', [StationController::class, 'index'])->middleware('admin');
Route::get('/admin/home/userMessages', [MessageController::class, 'getUserMessages'])->middleware('admin');
Route::post('/admin/home', [HomeController::class, 'addUser'])->middleware('admin');
Route::put('/admin/home/{id}', [HomeController::class, 'editUser'])->middleware('admin');
Route::put('/admin/home/clearStudent/{id}', [StationController::class, 'update'])->middleware('admin');
Route::put('admin/home/profile/{id}', [HomeController::class, 'editProfile'])->middleware('admin');
Route::delete('/admin/home/{id}', [HomeController::class, 'destroy'])->middleware('admin');
Route::delete('/admin/home/clearStudent/{id}', [StationController::class, 'destroy'])->middleware('admin');



// user routes
Route::get('/home/profile', [HomeController::class, 'getStudent'])->middleware('auth');
Route::put('/home/profile/{id}', [HomeController::class, 'editProfile'])->middleware('auth');
Route::get('/home', [StudentController::class, 'index'])->middleware('auth');
Route::post('/home', [StudentController::class, 'store'])->middleware('auth');
Route::prefix('/home', ['middleware' => 'auth'])->group(function () {
    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/messages', [MessageController::class, 'index']);
    Route::put('/{id}', [StudentController::class, 'update']);
    Route::delete('/{id}', [StudentController::class, 'delete']);
});
