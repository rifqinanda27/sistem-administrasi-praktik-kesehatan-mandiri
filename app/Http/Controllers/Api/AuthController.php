<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Contoh: assign role default
        $user->assignRole('user');

        return response()->json(['message' => 'Registered successfully']);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login'], 401);
        }

        $user = Auth::user();

        // Ambil semua permissions user
        $permissions = $user->getAllPermissions()->pluck('name');

        // Buat token sekalian assign permissions
        $token = $user->createToken('api-token', $permissions->toArray())->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
            'roles' => $user->getRoleNames()
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
