<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\API\MessageController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('admin/home', [HomeController::class, 'handleAdmin'])->name('admin.route')->middleware('admin');
Route::get('/home/download', [PdfController::class, 'index'])->middleware('auth');


// test
Route::get('/admin/home/userMessages', [MessageController::class, 'getUserMessages'])->middleware('admin');
