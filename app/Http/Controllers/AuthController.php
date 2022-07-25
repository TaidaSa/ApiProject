<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $filds = $request->validate([
            'name' => 'required|string',
            'email' => "required|string|unique:users,email",
            "password" => "required|string|confirmed",
        ]);

        $user = User::create([
            'name' => $filds['name'],
            'email' => $filds['email'],
            'password' => bcrypt($filds['password']),
        ]);

        $token = $user->createToken("myToken")->plainTextToken;

        $response = [
            "User" => $user,
            "token" => $token,
        ];

        // $response = [
        //     "user" => $user
        // ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $filds = $request->validate([
            'email' => "required|string",
            "password" => "required|string",
        ]);

        $user = User::where("email",$filds['email'])->first();
        if(!$user || !Hash::check($filds['password'], $user->password)){
            return response([
                "messege" => "bad login"
            ], 404);
        }

        $token = $user->createToken("myToken")->plainTextToken;
        $response = [
            "User" => $user,
            "token" => $token,
        ];
        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            "messege" => "logout Successfuly",
        ];
    }
}
