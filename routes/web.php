<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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


Route::get('login', [AuthController::class, 'index'])->name('user.login');
Route::post('login', [AuthController::class, 'authenticate'])->name('user.login.submit');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('chat/{receiver}', [HomeController::class, 'chat'])->name('chat');

//    Route::get('/chat', function () {
//        return view('welcome');
//    })->name('chat');
//
//
//    Route::get('/', function () {
//        return view('home');
//    })->name('home');


});

