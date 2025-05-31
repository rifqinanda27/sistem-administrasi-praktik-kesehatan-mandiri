<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;

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
            }
        });
    }
}
