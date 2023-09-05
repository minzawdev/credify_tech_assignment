<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request)
    {

        if (Auth::attempt($request->only(['email', 'password']))) {

            $user = Auth::user();
            $user['token'] = $user->createToken('credifyApp')->accessToken;

            return new UserResource($user);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 402);
    }

    public function register(UserRegisterRequest $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $user['token'] = $user->createToken('movieApp')->accessToken;

        return new UserResource($user);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
