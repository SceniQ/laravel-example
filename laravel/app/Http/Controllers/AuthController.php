<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register user
    public function register(Request $request){
        //1 - Validate form
        $fields = $request -> validate([
            'username' => ['required','max:255'],
            'email' => ['required','max:255', 'email','unique:users'],
            'password' => ['required','min:3','max:8','confirmed']
        ]);
        //2 - Register user - persist data in DB
        $user = User::create($fields);

        //3 - Login
        Auth::login($user);

        //4 - Redirect to Homepage
        return redirect() -> route('home');

        // die + dump/ die, dump + debug
        //dd($request->username);
    }

    //Login user
    public function login(Request $request){
        $fields = $request -> validate([
            'email' => ['required','max:255', 'email'],
            'password' => ['required']
        ]);

    
        // Dump data
        dd($fields,$request->remember,Auth::attempt($fields, $request->remember));
        
        //Try to log the user in
        // if(Auth::attempt($fields, $request->remember)){
        //     return redirect() -> route('home');
        // }else{
        //     return back() -> withErrors(['failed'=> 'The provided credentials do match our records.']);
        // }

    }
}
