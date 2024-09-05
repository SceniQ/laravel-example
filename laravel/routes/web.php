<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordResetController;
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
    //User registration
    Route::view('/register','auth.register') ->name('register');
    Route::post('/register',[AuthController::class, 'register']);

    //User login
    Route::view('/login','auth.login') ->name('login');
    Route::post('/login',[AuthController::class, 'login']);

    //password request and email handling
    //Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
    Route::get('/forgot-password', [PasswordResetController::class,'requestPassword'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class,'handlePasswordEmail'])->name('password.email');

    //pasword reset and update
    Route::get('/reset-password/{token}', [PasswordResetController::class,'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class,'updatePassword'])->name('password.update');
});
Route::redirect('/','posts') ->name('home');
Route::resource('posts',PostController::class);
Route::get('/{user}/posts',[PostController::class,'userPosts'])->name('posts.user');   