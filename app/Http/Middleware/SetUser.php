<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SetUser
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah sudah ada token di session
        $token = session('api_token');

        if ($token) {
            // Ambil data user menggunakan token
            $response = Http::withToken($token)->get('http://pbl-healthcare.test/api/user');

            if ($response->successful()) {
                // Simpan data user ke dalam session (atau langsung ke view)
                session(['user' => $response->json()]);
            }
        }

        return $next($request);
    }
}
