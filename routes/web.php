<?php

use App\Http\Controllers\DBBackupController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DokterUmumController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterUmumControllerPasien;
use App\Http\Controllers\DokterUmumControllerCalonPasien;
use App\Http\Controllers\DokterUmumControllerTindakan;
use App\Http\Controllers\DokterUmumControllerPerluTindakan;
use App\Http\Controllers\DokterUmumControllerPerluRujukan;
use App\Http\Controllers\DokterUmumControllerTidakRujukan;
use App\Http\Controllers\DokterUmumControllerPerluTindakanComplete;
use App\Http\Controllers\DokterUmumControllerRekamMedis;


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

Route::get('/', function () {
    return view('welcome');
});

Route::permanentRedirect('/', '/login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('profil', ProfilController::class)->except('destroy');

Route::resource('manage-user', UserController::class);
Route::resource('manage-role', RoleController::class);
Route::resource('manage-menu', MenuController::class);
Route::resource('manage-permission', PermissionController::class)->only('store', 'destroy');

route::resource('dokter-umum-branda', DokterUmumController::class);
route::resource('dokter-umum-pasien', DokterUmumControllerPasien::class);
route::resource('dokter-umum-calonpasien', DokterUmumControllerCalonPasien::class);
route::resource('dokter-umum-tindakan', DokterUmumControllerTindakan::class);
route::resource('dokter-umum-perlutindakan', DokterUmumControllerPerluTindakan::class);
route::resource('dokter-umum-perlurujukan', DokterUmumControllerPerluRujukan::class);
route::resource('dokter-umum-tidakrujukan', DokterUmumControllerTidakRujukan::class);
route::resource('dokter-umum-complete', DokterUmumControllerPerluTindakanComplete::class);
route::resource('pasien-rekam-medis', DokterUmumControllerRekamMedis::class);

Route::get('dbbackup', [DBBackupController::class, 'DBDataBackup']);


