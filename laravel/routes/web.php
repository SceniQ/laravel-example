<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware("auth")->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::view('/dashboard','users.dashboard')->name('dashboard');
});

Route::middleware("guest")->group(function () {
    Route::view('/register','auth.register') ->name('register');
    Route::post('/register',[AuthController::class, 'register']);

    Route::view('/login','auth.login') ->name('login');
    Route::post('/login',[AuthController::class, 'login']);
});
Route::redirect('/','posts') ->name('home');
Route::resource('posts',PostController::class);
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');