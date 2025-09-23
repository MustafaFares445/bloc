<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisteerRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255' , Rule::exists('users', 'email')],
        ]);

        if (!Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
            return response()->json(['error' => 'Invalide Credintial'], 401);

        $user = Auth::user();
        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => UserResource::make($user),
        ]);
    }

    public function register(RegisteerRequest $request)
    {
        $user = User::query()->create($request->validated());

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => UserResource::make($user),
        ]);
    }

    public function logout()
    {

    }
}
