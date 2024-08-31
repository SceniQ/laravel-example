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
    Route::get('/dashboard',[DashboardController::class,'index'])->middleware('verified')->name('dashboard');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
    //Route::view('/dashboard','users.dashboard')->name('dashboard');
    
    //The Email Verification Notice
    Route::get('/email/verify',[AuthController::class, 'verifyNotice'])->name('verification.notice');
    //The Email Verification Handler
    Route::get('/email/verify/{id}/{hash}',[AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
    //Resending the Verification Email
    Route::post('/email/verification-notification',[AuthController::class, 'verifyHandler'])->middleware('throttle:6,1')->name('verification.send');
    //Protecting Routes

});

Route::middleware("guest")->group(function () {
    Route::view('/register','auth.register') ->name('register');
    Route::post('/register',[AuthController::class, 'register']);

    Route::view('/login','auth.login') ->name('login');
    Route::post('/login',[AuthController::class, 'login']);
});
Route::redirect('/','posts') ->name('home');
Route::resource('posts',PostController::class);
Route::get('/{user}/posts',[PostController::class,'userPosts'])->name('posts.user');   