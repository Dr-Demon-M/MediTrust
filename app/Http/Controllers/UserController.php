<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserloginResource;
use App\Http\Resources\UserRegisterResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // just a normal create 
    public function register(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return New UserRegisterResource($user);
    }


    // login for get token
    public function login(Request $request)
    {
        // normal validation
        $user = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:5'
        ]);

    // if condition for if no password or email in request which is received from user
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }

    // if recieved email and password -> go to model where email field = email from the request and get first line 
        $user = User::where('email', $request->email)->firstorfail();
    // for the first line obtained from the previous command -> create a token and get it as plain text
        $token = $user->createToken('auth_token')->plainTextToken;

        return New UserloginResource($user,$token);
    }

    // delete token from profile_tokens == logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => ['User logged out successfully', 'See You Soon']
        ], 202);
    }
}
