<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $userInfo = $request->all();
        $rules = [
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ];
        $validator = Validator::make($userInfo, $rules);

        if ($validator->fails()) 
        {
            return response([ 'success' => false, 'message' => $validator->messages()]);
        }
        else 
        {
            $userInfo['password'] = bcrypt($request->password);
            $user = User::create($userInfo);
            $accessToken = $user->createToken('authToken')->accessToken;
            return response([ 'success' => true, 'user' => $user, 'token' => $accessToken]);
        }
    }

    public function login(Request $request)
    {
        $loginInfo = $request->all();
        $rules = [
            'email' => 'email|required',
            'password' => 'required'
        ];
        $validator = Validator::make($loginInfo, $rules);

        if ($validator->fails())
        {
            return response([ 'success' => false, 'message' => $validator->messages()], 400);
        }
        else
        {
            if (!auth()->attempt($loginInfo)) {
                return response(['success' => false, 'message' => 'Invalid Credentials'], 400); 
            }
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return response([ 'success' => true, 'user' => auth()->user(), 'token' => $accessToken]);
        }
    }

    public function logout(Request $request)
    {
        var_dump("asdfasdf");exit;
        $user = auth()->user()->token();
        var_dump($user);
    }

}
