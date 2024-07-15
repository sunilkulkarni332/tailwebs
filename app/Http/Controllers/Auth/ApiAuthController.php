<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\UserResource;
use App\Http\Resources\ArticleResource;

class ApiAuthController extends Controller
{
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;
        $response = ['token' => $token];
        return response($response, 200);
    }

    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;
                $userInfo = User::where('email', $request->email)->first();
                $userInfo->user_token = $token;
                $userInfo->save();
                $userData = new UserResource($userInfo);                
                $response = ['token' => $token,'user' => $userData];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function logouts (Request $request) {
        $token = $request->user()->token();
        $token->revoke();        
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function userResuorce(Request $request){
        $userInfo = User::where('email', $request->email)->with('products','articles')->first();
        if($userInfo != null){
            $userData = new UserResource($userInfo);
            $response = ["message" =>'User data','user' => $userData];
            return response($response, 200);
        }else{
            $response = ["message" =>'User does not exist'];
            return response($response,422);
        }
    }
}
