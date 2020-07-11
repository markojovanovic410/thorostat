<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;

class UserController extends Controller
{
    public function getByParams(Request $request)
    {
        $users = User::when($request->user_type, function($query) use ($request) {
            $query->where("user_type", $request->user_type);
        })
        ->when($request->first_name, function($query) use ($request) {
            $query->where("first_name", $request->first_name);
        })
        ->when($request->last_name, function($query) use ($request) {
            $query->where("last_name", $request->last_name);
        })
        ->when($request->email, function($query) use ($request) {
            $query->where("email", $request->email);
        })
        ->when($request->phone, function($query) use ($request) {
            $query->where("phone", $request->phone);
        })
        ->when($request->id, function($query) use ($request) {
            $query->where("id", $request->id);
        })
        ->get();

        return response([ 'success' => true, 'users' => $users]);
    }

    public function store(Request $request)
    {
        $userInfo = $request->all();
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'user_type' => 'required',
        );
        $validator = Validator::make($userInfo, $rules);
        if ($validator->fails())
        {
            return response([ 'success' => false, 'message' => $validator->messages()]);
        }
        else
        {
            $userInfo['password'] = bcrypt($request->password);
            $user = User::create($userInfo);
            return response([ 'success' => true, 'user' => $user, 'message' => 'Success!']);
        }
    }

    public function update(Request $request)
    {
        $userInfo = $request->all();
        $user = User::where("id", $userInfo["id"])->update($userInfo);
        return response([ 'success' => true, 'user' => $user, 'message' => 'Success!']);
    }

    public function uploadAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);

        if ($validator->passes())
        {
            $imageName = time().'.'.$request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('storage/avatar'), $imageName);

            return response(['success' => true, 'message' => "Success!", 'avatar' => $imageName]);
        }

        return response(['success' => false, 'message' => "Something went wrong! Try again."]);
    }

    public function delete(Request $request)
    {
        $user_id = $request->user_id;
        $success = User::destroy($user_id);

        if ($success)
            return response(["success" => true, 'message' => 'Success!']);
        else
            return response(["success" => false, 'message' => 'No records found with the key.']);
    }
}
