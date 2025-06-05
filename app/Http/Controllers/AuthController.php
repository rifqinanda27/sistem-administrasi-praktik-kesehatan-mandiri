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
        // ✅ Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 🔐 Kirim request login ke API
        $response = Http::post("$this->apiBaseUrl/login", [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // ❌ Jika login gagal, tampilkan pesan error dari API jika tersedia
        if (!$response->successful()) {
            $errorMessage = 'Login gagal. Silakan coba lagi.';

            $responseData = $response->json();
            if (isset($responseData['message'])) {
                $errorMessage = $responseData['message'];
            }

            return back()->withErrors(['email' => $errorMessage])->withInput();
        }

        // ✅ Jika login berhasil
        $data = $response->json();

        // Simpan token, user info, dan role ke session
        session([
            'api_token' => $data['token'],
            'user' => $data['user'],
            'user_role' => $data['role'],
        ]);
        session()->save();

        // 🔁 Arahkan user berdasarkan role
        switch ($data['role']) {
            case 'admin':
                return redirect()->route('users.index');
            case 'dokterumum':
                return redirect()->route('tindakan.index');
            case 'resepsionis':
                return redirect()->route('pasien-resepsionis.index');
            case 'apoteker':
                return redirect()->route('resep.index');
            case 'kasir':
                return redirect()->route('pembayaran.index');
            default:
                return redirect()->route('home');
        }
    }

    public function logout()
    {
        $token = session('api_token');
        Http::withToken($token)->post("$this->apiBaseUrl/logout");
        session()->forget(['api_token', 'user', 'user_role']);
        return redirect()->route('login');
    }
}
