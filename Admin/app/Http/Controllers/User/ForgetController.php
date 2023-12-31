<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\ForgetRequest;
use App\Mail\ForgetMail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; 

class ForgetController extends Controller
{
    public function ForgetPassword(ForgetRequest $request) {
        $email = $request->email;

        if (User::where('email', $email)->doesntExist()){
            return response()->json([
                'message' => "Email Invalid or doesnt exist"
            ], 401);
        }

        $token = rand(10,100000);
        try 
            {
                DB::table('password_resets')->insert([
                    'email' => $email, 
                    'token' => $token
                ]);

                Mail::to($email)->send(new ForgetMail($token));

                return response()->json([
                    'message' => "Reset Password Mail has been sent to your email"
                ], 200);

            } catch(Exception $exception){
                return response()->json([
                    'message' => $exception->getMessage()
                ], 400);
            }
    }
}
