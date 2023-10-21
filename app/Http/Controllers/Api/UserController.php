<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {
        $user = User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'birth_date'=>$request->birth_date,
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        
        return response(['success'=>true , 'data'=>$user]);
    }
    
    public function login(UserRequest $request)
    {
        if(!Auth::attempt(['email'=>$request->email , 'password'=>$request->password , 'status'=>'active']))
        {
            return response(['message'=>'Unauthorized','code'=>401]);
        }

        $user= User::where('email', $request->email)->first();
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = ['user'=>$user , 'token'=>$token , 'code'=>200];
        return response(['success'=>true , 'data'=>$response]);
    }

    public function show()
    {
        $user = Auth::user();
        return response(['success'=>true , 'data'=>$user]);
    }

    public function update(UserRequest $request)
    {
        $user = User::find(Auth::id());
        
        $user->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'birth_date'=>$request->birth_date,
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        return response(['success'=>true , 'data'=>$user]);
    }
}
