<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function loginUser(Request $request){
        try {
            $request->validate([

                'email'=>'required|string|email',
                'password'=>'required|string'   
               ]);

            $fields = $request->only('email', 'password');
            //Check email       
            $user = User::where('email', $fields['email'])->first();
       
            if (Auth::attempt($fields)) {
                $user = Auth::user();
                $token = $user->createToken('authToken')->accessToken;
            }

            //Check Password               
            if(!$user || !Hash::check($fields['password'], $user->password) ){
                return response(['message' => "Invalid login"], 401);
            }

            $response = [
                'role' => $user->role,
            ];
       
            return response($response, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => "Invalid login"], 401);
        }
    }

    public function logoutUser() 
    {
        try {
            Auth::logout();
            return response()->json(['message' => "logout success"] , 200);
        } catch (\Exception $e) {
            return response()->json(['message' => "Unauthorized user"], 401);
        }
    }

}
