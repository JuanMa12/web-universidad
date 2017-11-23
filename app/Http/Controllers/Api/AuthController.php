<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Transformers\UserTransformer;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;

class AuthController extends Controller
{

    public function index(Request $request)
    {
        return JWTAuth::parseToken()->toUser();
    }

    public function login(LoginUserRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user != null){
            if($user->active == '1')
            {
                try{
                    $token = JWTAuth::attempt($request->only('email','password'),[
                        'exp' => Carbon::now()->addWeek()->timestamp,
                    ]);

                }catch (JWTException $e){
                    return response()->json(
                        ['incorrect' => 'Email o password incorrect'],500
                    );
                }
            }else{
                return response()->json(
                    ['incorrect' => 'Email not active'],481
                );
            }
        }else{
            return response()->json(
                ['incorrect' => 'Email o password incorrect'],481
            );
        }


        if($token == false){
            return response()->json(
                ['incorrect' => 'Verify email and password'],481
            );
        }else{
            return response()->json(['token'=> $token]);
        }
    }



    public function user(Request $request)
    {
         $user = JWTAuth::parseToken()->toUser();
         $users = ['0' => $user];
         return response()->json([
           'users' => $users
         ]);

    }

}
