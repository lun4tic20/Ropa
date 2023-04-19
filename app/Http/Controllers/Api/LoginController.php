<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request){
        $this->validateLogin($request);

        if(Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'token'=>$request->user()->createtoken($request->name)->plainTextToken,
                'message'=>'Success'
            ]);
        }
        return response()->json([
            'message'=>'Unauthorized'
        ], 401);
    }

    public function validateLogin(Request $request){
        return $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required'
        ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return[
            'message'=>'Adiós'
        ];
    }
}
