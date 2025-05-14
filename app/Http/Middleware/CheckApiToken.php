<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class CheckApiToken
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah session memiliki api_token
        $token = session('api_token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['msg' => 'Please login first']);
        }

        // Ambil base URL dari config/services.php
        $apiBaseUrl = config('services.api.base_url');

        // Verifikasi apakah token masih valid dengan API menggunakan base URL yang sudah didefinisikan
        $response = Http::withToken($token)->get($apiBaseUrl . '/user');

        if (!$response->successful()) {
            // Jika response gagal, anggap token sudah tidak valid
            session()->forget('api_token');
            return redirect()->route('login')->withErrors(['msg' => 'Session expired, please login again']);
        }

        // Lanjutkan request jika token valid
        return $next($request);
    }
}
