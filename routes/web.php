<?php

use App\Http\Controllers\DBBackupController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebLoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::permanentRedirect('/', '/login');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::resource('profil', ProfilController::class)->except('destroy');

// Route::resource('manage-user', UserController::class);
// Route::resource('manage-role', RoleController::class);
// Route::resource('manage-menu', MenuController::class);
// Route::resource('manage-permission', PermissionController::class)->only('store', 'destroy');


// Route::get('dbbackup', [DBBackupController::class, 'DBDataBackup']);


// Home
Route::get('/', fn () => redirect('/login'));

// === Auth via API ===
Route::get('/login', [WebLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WebLoginController::class, 'login']);
Route::post('/logout', [WebLoginController::class, 'logout'])->name('logout');

// === Protected by token session ===
Route::middleware('check.api.token')->group(function () {

    Route::get('/home', function () {
        $token = session('api_token');
    
        $response = Http::withToken($token)->get('http://sistem-administrasi-praktik-kesehatan-mandiri.test/api/user');
    
        if (!$response->successful()) {
            return redirect()->route('login')->withErrors(['msg' => 'Session expired']);
        }
    
        $user = $response->json();
    
        // Panggil helper dan pass data user
        $menus = \App\Helpers\MenuHelper::Menu($user);

        // dd($user);    
    
        return view('home', compact('user', 'menus'));
    })->name('home');    


    // Data Management
    Route::resource('profil', ProfilController::class)->except('destroy');
    Route::resource('manage-user', UserController::class);
    Route::resource('manage-role', RoleController::class);
    Route::resource('manage-menu', MenuController::class);
    Route::resource('manage-permission', PermissionController::class)->only('store', 'destroy');

    // DB Backup
    Route::get('dbbackup', [DBBackupController::class, 'DBDataBackup']);
});