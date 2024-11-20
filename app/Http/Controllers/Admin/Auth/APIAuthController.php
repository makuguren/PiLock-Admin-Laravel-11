<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class APIAuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if(!$admin || !Hash::check($request->password, $admin->password)){
            return response()->json([
                'message' => 'The Password Credentials are Incorrect'
            ], 401);
        }

        $token = $admin->createToken($admin->first_name . ' ' . $admin->last_name)->plainTextToken;

        return response()->json([
            'message' => 'You have successfully logged in',
            'token_type' => 'Bearer',
            'token' => $token
        ], 201);
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email',
            'password' => 'required|string|min:8|max:255',
        ]);

        $admin = Admin::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($admin){
            $token = $admin->createToken($admin->first_name . ' ' . $admin->last_name . ' Auth Token')->plainTextToken;

            return response()->json([
                'message' => 'You have successfully registered',
                'token_type' => 'Bearer',
                'token' => $token
            ], 201);
        } else {
            return response()->json([
                'message' => 'Something went wrong! while registering'
            ], 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $admin = Admin::where('id', $request->user()->id)->first();

        if($admin){
            $admin->tokens()->delete();

            return response()->json([
                'message' => 'You have successfully logged out'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Something went wrong! while logging out'
            ], 500);
        }
    }
}
