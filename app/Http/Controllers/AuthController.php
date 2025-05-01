<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = config('services.api.base_url');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $response = Http::post("$this->apiBaseUrl/login", [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (!$response->successful()) {
            return back()->withErrors(['email' => 'Email atau password salah']);
        }

        $data = $response->json();
        
        // Simpan token ke session
        session(['api_token' => $data['token']]);
        session()->save(); // <<< Tambahan penting agar session tersimpan sebelum redirect

        return redirect()->route('home');
    }


    public function logout()
    {
        $token = session('api_token');

        Http::withToken($token)->post("$this->apiBaseUrl/logout");
        session()->forget('api_token');

        return redirect()->route('login');
    }
}
