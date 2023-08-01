<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Facades\DB;

class ResetController extends Controller
{
    public function ResetPassword(ResetRequest $request) {
        $email =  $request->email;
        $token = $request->token;
        $password = Hash::make($request->password);

        $emailCheck = DB::table('password_resets')->where('email', $email)->first();
        $pinCheck = DB::table('password_resets')->where('token', $token)->first();

        if (!$emailCheck) {
            return response()->json([
                'message' => "Email Not Found"
            ], 401);
        }

        if (!$pinCheck) {
            return response()->json([
                'message' => "Pin Code is Invalid"
            ], 401);
        }

        DB::table('users')->where('email', $email)->update(['password'=> $password]);
        DB::table('password_resets')->where('email', $email)->delete();

        return response()->json([
            'message' => " Password has been changed successfully"
        ], 200);
    }
}
