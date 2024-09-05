<?php

namespace App\Http\Controllers;

use App\Events\UserSubscribed;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // Register user
    public function register(Request $request){
        //1 - Validate form
        $fields = $request -> validate([
            'username' => ['required','max:255'],
            'email' => ['required','max:255', 'email','unique:users'],
            'password' => ['required','min:3','max:20','confirmed']
        ]);

        //2 - Register user - persist data in DB
        $user = User::create($fields);
        //3 - Login
        Auth::login($user);
        //4 - send email verification
        event(new Registered($user));

        //call event if user clicked
        if($request->subscribe){
            event(new UserSubscribed($user));
        }
       

        //5 - Redirect to Homepage
        return redirect() -> route('dashboard');

    }

    //Login user
    public function login(Request $request){
        $fields = $request -> validate([
            'email' => ['required','max:255', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($fields, $request->remember)) {
            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors([
                'failed' => 'The provided credentials do not match our records.'
            ]);
        }
    }

    //Logout user
    public function logout(Request $request){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect() -> route('home');
    }

    public function verifyNotice(){
        return view('auth.verify-email');
    }

    public function verifyEmail(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect() -> route('dashboard');
    }

    public function verifyHandler(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

    

}
