<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    //login user via passport
    public function login(Request $request){
        $login = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);
        if(! Auth::attempt($login)){
            return response(['message' => 'Invalid login credentials']);
        }
        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return response ([
            'user' => Auth::user(), 'access_token' => $accessToken
        ]);
    }
    //return all users
    public function index(){
        return User::get();
    }
}
