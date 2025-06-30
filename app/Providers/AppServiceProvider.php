<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use App\Models\Pengaturan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        View::composer('*', function ($view) {
            $token = session('api_token');
    
            if ($token) {
                $apiBaseUrl = config('services.api.base_url');

                $response = Http::withToken($token)->get($apiBaseUrl . '/user');
    
                if ($response->successful()) {
                    $user = $response->json();
                    $view->with('user', $user);
                } else {
                    session()->forget('api_token'); // token invalid, logout paksa
                }

                $pengaturan = Http::withToken($token)
                    ->get($apiBaseUrl . '/pengaturan')
                    ->json('data');

                $view->with('pengaturan', $pengaturan);
            }
        });

        View::composer('auth.login', function ($view) {
            $pengaturan = Pengaturan::select('logo', 'nama_aplikasi')->first(); // hanya ambil kolom logo
            $view->with('pengaturan', $pengaturan);
        });
    }
}
