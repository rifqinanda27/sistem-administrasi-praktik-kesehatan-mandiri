<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $response = Http::post('http://sistem-administrasi-praktik-kesehatan-mandiri.test/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (!$response->successful()) {
            return back()->withErrors(['email' => 'Email atau password salah']);
        }

        $data = $response->json();
        session(['api_token' => $data['token']]);

        return redirect()->route('home');
    }

    public function logout()
    {
        $token = session('api_token');

        Http::withToken($token)->post('http://sistem-administrasi-praktik-kesehatan-mandiri.test/api/logout');
        session()->forget('api_token');

        return redirect()->route('login');
    }

}
