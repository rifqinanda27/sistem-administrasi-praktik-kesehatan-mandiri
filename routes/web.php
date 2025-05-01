<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\DokterUmum\PasienController;
use App\Http\Controllers\DokterUmum\TindakanController;

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
        return view('home');
    })->name('home');

    
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('pasien', PasienController::class);
    Route::resource('tindakan', TindakanController::class);
    Route::get('rekam-medis/{id}', [PasienController::class, 'rekam_medis']);
      
});