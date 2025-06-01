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

    // public function login(Request $request)
    // {
    //     $response = Http::post("$this->apiBaseUrl/login", [
    //         'email' => $request->email,
    //         'password' => $request->password,
    //     ]);

    //     if (!$response->successful()) {
    //         return back()->withErrors(['email' => 'Email atau password salah']);
    //     }

    //     $data = $response->json();
        
    //     // Simpan token ke session
    //     session(['api_token' => $data['token']]);
    //     session()->save(); // <<< Tambahan penting agar session tersimpan sebelum redirect

    //     return redirect()->route('home');
    // }

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

        // Simpan token dan user ke session
        session([
            'api_token' => $data['token'],
            'user' => $data['user'],
            'user_role' => strtolower($data['role']), // simpan role juga
        ]);

        session()->save();

        // Redirect sesuai role
        switch (strtolower($data['role'])) {
            case 'admin':
                return redirect()->route('users.index'); // atau dashboard admin
            case 'dokterumum':
                return redirect()->route('pasien.index');
            case 'kasir':
                return redirect()->route('home');
            case 'resepsionis':
                return redirect()->route('pasien-resepsionis.index');
            case 'apoteker':
                return redirect('/obat');
            default:
                return redirect()->route('home'); // fallback
        }
    }



    public function logout()
    {
        $token = session('api_token');

        Http::withToken($token)->post("$this->apiBaseUrl/logout");
        session()->forget('api_token');

        return redirect()->route('login');
    }
}
