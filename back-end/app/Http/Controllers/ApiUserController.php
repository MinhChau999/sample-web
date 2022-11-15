<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    public function register(ApiRegisterRequest $request){
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($user->password);
        $user->save();
        $user->token = $user->createToken('app')->accessToken;
        return response()->json($user);
    }

    public function login(ApiLoginRequest $request){
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            $user = Auth::user();
            $user->token = $user->createToken('app')->accessToken;
            return response()->json($user);
        }
    }

    public function infoUser(){
        return response()->json(auth('api')->user());
    }
}
