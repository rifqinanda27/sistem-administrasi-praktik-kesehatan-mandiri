<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', fn () => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// === Protected by token session ===
Route::middleware('check.api.token')->group(function () {

    Route::get('/home', function () {
        $token = session('api_token');
    
        $response = Http::withToken($token)->get('http://pbl-healthcare.test/api/user');
    
        if (!$response->successful()) {
            return redirect()->route('login')->withErrors(['msg' => 'Session expired']);
        }
    
        $user = $response->json();
    
        // Hilangkan pemanggilan helper yang tidak ada
        // $menus = \App\Helpers\MenuHelper::Menu($user);
    
        return view('home', compact('user'));
    })->name('home');

    
    Route::resource('users', UserController::class);
      
});