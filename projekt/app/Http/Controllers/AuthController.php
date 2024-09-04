<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Registerar användare
    public function register(Request $request) {
        $validatedUser = Validator::make(
            $request->all(),
            [
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required'
            ]
        );
        // Inkorrekta värden
        if($validatedUser->fails()) {
            return response()->json([
                'message'=>'Validation error',
                'error' => $validatedUser->errors()
            ], 401);
        }
        // Korrekta värden - lagra användare och returna en token
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password']
        ]);

        $token = $user->createToken('APITOKEN')->plainTextToken;

        $response = [
            'message' => 'User Created Successfully',
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    //Login User 
    public function login(Request $request) {
        $validatedUser = Validator::make(
            $request->all(),
            [
                'email'=>'required|email',
                'password'=>'required'
            ]
        );
        // Inkorrekta värden
        if($validatedUser->fails()) {
            return response()->json([
                'message'=>'Validation error',
                'error' => $validatedUser->errors()
            ], 401);
        }

        // Inkorrekt login
        if(!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'infvalid credentials'
            ], 401);
        }

        //Korrekt login
        $user = User::where('email', $request->email)->first();

        return response()->json([
            'message' => 'User Logged in',
            'token'=> $user->createToken('APITOKEN')->plainTextToken
        ], 200);
    }

    //Logout User
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        $response = [
            'message' =>'User logged out'
        ];

        return response($response,200);
    }
}
