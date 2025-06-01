<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\DokterUmum\PasienController;
use App\Http\Controllers\DokterUmum\TindakanController;
use App\Http\Controllers\ResepsionisController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\KasirController;

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

    // Admin
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('dokter', DokterController::class);
    
    // Dokterumum
    Route::resource('pasien', PasienController::class);
    Route::resource('tindakan', TindakanController::class);
    Route::get('perlu-tindakan/{id}', [TindakanController::class, 'perlu_tindakan']);
    Route::get('perlu-tindakan/{id}/perlu-rujukan', [TindakanController::class, 'perlu_rujukan'])->name('perlu-rujukan');
    Route::get('perlu-tindakan/{id}/tidak-perlu-rujukan', [TindakanController::class, 'tidak_perlu_rujukan'])->name('tidak-perlu-rujukan');
    Route::get('perlu-tindakan/{id}/complete', [TindakanController::class, 'tindakan_complete'])->name('tindakan-complete');
    Route::get('rekam-medis/{id}', [PasienController::class, 'rekam_medis']);
    Route::post('perlu-tindakan', [TindakanController::class, 'tambah_catatan_medis'])->name('perlu-tindakan-store');
    Route::post('perlu-tindakan/{id}', [TindakanController::class, 'update_catatan_medis'])->name('perlu-tindakan-update');
    Route::post('perlu-rujukan-store/{id}', [TindakanController::class, 'perlu_rujukan_store'])->name('perlu-rujukan-store');
    Route::post('perlu-tindakan/resep-obat-dokter', [TindakanController::class, 'resep_obat_dokter'])->name('resep-obat-dokter');
    Route::get('/cari-obat', [TindakanController::class, 'cari_obat']);
    Route::get('/cari-instruksi', [TindakanController::class, 'cari_instruksi']);
    
    // Resepsionis
    Route::resource('pasien-resepsionis', ResepsionisController::class);
    Route::get('kunjungan-pasien', [ResepsionisController::class, 'kunjungan_index'])->name('kunjungan.index');
    Route::get('kunjungan-pasien/create', [ResepsionisController::class, 'kunjungan_create'])->name('kunjungan.create');
    Route::get('kunjungan-pasien/{id_kunjungan}/anamnesa', [ResepsionisController::class, 'anamnesa_create'])->name('anamnesa');
    Route::get('/cari-pasien', [ResepsionisController::class, 'cari_pasien']);
    Route::get('/cari-dokter', [ResepsionisController::class, 'cari_dokter']);
    Route::post('kunjungan-pasien', [ResepsionisController::class, 'kunjungan_store'])->name('kunjungan.store');
    Route::post('anamnesa-pasien', [ResepsionisController::class, 'anamnesa_store'])->name('anamnesa.store');
    Route::get('lab-pasien', [ResepsionisController::class, 'lab_resepsionis']);
    Route::get('cetak-permintaan/{id}', [ResepsionisController::class, 'getPermintaanLab'])->name('cetak-permintaan');

    // Apoteker
    Route::resource('obat', ApotekerController::class);

    Route::get('intruksi', [ApotekerController::class, 'intruksi_index'])->name('instruksi.index');
    Route::get('intruksi/create', [ApotekerController::class, 'intruksi_create'])->name('instruksi.create');
    Route::get('intruksi/{id}/edit', [ApotekerController::class, 'intruksi_edit'])->name('instruksi.edit');
    Route::post('intruksi', [ApotekerController::class, 'intruksi_store'])->name('instruksi.store');
    Route::put('intruksi/{id}', [ApotekerController::class, 'intruksi_update'])->name('instruksi.update');
    Route::delete('intruksi/{id}', [ApotekerController::class, 'instruksi_destroy'])->name('instruksi.destroy');


    Route::get('resep', [ApotekerController::class, 'resep_index'])->name('resep.index');
    Route::get('resep/{id}/create', [ApotekerController::class, 'resep_create'])->name('resep.create');
    Route::post('resep/{id}', [ApotekerController::class, 'resep_store'])->name('resep.store');


    // Kasie
    Route::resource('pembayaran', KasirController::class);
});