<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

use Exception;
use PDOException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Handle offline database

        //Use bootstrap 4 for pagination css
        Paginator::useBootstrapFour();
        View::composer('*', function ($view) {
            $token = session('api_token');

            $user = null;
            $menus = [];

            if ($token) {
                $response = Http::withToken($token)->get('http://sistem-administrasi-praktik-kesehatan-mandiri.test/api/user');

                if ($response->successful()) {
                    $user = $response->json();
                    $menus = \App\Helpers\MenuHelper::Menu($user);
                }
            }

            $view->with('user', $user)->with('menus', $menus);
        });
    }
}
