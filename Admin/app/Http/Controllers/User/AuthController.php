<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Login(Request $request){
        try
            {
                if(Auth::attempt($request->only('email', 'password'))) {
                    $user = Auth::user();
                    $token = $user->createToken('app')->accessToken;

                    return response()->json([
                        'message' => "Successfully Logged in",
                            'token' => $token,
                            'user' => $user
                    ], 200);
                }

            }catch(Exception $exception){
                return response()->json([
                    'message' => $exception->getMessage()
                ], 400);
            }

            return response()->json([
                'message' => "Invalid Email Or Password and User does not exist"
            ], 401);
    }

    public function Register(RegisterRequest $request){
        try
            {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);

                $token = $user->createToken('app')->accessToken;

                return response()->json([
                    'message' => "Registration Successful",
                    'token' => $token,
                    'user' => $user
                ], 200);

            }catch(Exception $exception){
                return response()->json([
                    'message' => $exception->getMessage()
                ], 400);
            }
    }
}
