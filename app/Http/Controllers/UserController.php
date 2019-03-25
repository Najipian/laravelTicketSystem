<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            return response()->json(['token' => Auth::user()->createToken('tickets')->accessToken]);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
}
