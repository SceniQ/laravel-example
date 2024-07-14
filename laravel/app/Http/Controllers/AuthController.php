<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Register user
    public function register(Request $request){
        //1 - Validate form
        //2 - Register
        //3 - Login
        //4 - Redirect
        dd($request->username);
    }
}
