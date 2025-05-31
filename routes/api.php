<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\VisitController;
use App\Http\Controllers\Api\CatatanMedisController;
use App\Http\Controllers\Api\TindakanController;
use App\Http\Controllers\Api\ResepController;
use App\Http\Controllers\Api\ObatController;
use App\Http\Controllers\Api\LaboratoriumController;
use App\Http\Controllers\Api\JenisPemeriksaanLabController;
use App\Http\Controllers\Api\PermintaanLabController;
use App\Http\Controllers\Api\HasilLabController;
use App\Http\Controllers\Api\ApotekerController;
use App\Http\Controllers\Api\DokterController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    
    Route::post('/logout', [AuthController::class, 'logout']);

    // Route::middleware('role:admin')->group(function () {
    //     Route::get('/dashboard', [AdminController::class, 'dashboard']);
    // });

    // Route::prefix('user')->middleware('role:user')->group(function () {
    //     Route::get('/profile', [UserController::class, 'profile']);
    // });
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('/users', UserController::class);
        Route::apiResource('/roles', RoleController::class);
        Route::apiResource('/dokter', DokterController::class);
    });
    
    Route::middleware('role:resepsionis,dokterumum')->group(function () {
        Route::get('cetak-permintaan/{id}', [PermintaanLabController::class, 'cetak_permintaan']);
        Route::apiResource('/pasien', PatientController::class);
        Route::apiResource('/kunjungan', VisitController::class);
        Route::get('/cari-dokter', [DokterController::class, 'index']);
        Route::get('/tipe-kunjungan', [VisitController::class, 'tipe_kunjungan']);
        Route::get('/status-kunjungan', [VisitController::class, 'status_kunjungan']);
        Route::apiResource('/catatan-medis', CatatanMedisController::class);
    });
    
    Route::middleware('role:dokterumum,apoteker')->group(function () {
        Route::apiResource('obat', ObatController::class);
        Route::apiResource('resep', ResepController::class);
        Route::get('instruksi', [ApotekerController::class, 'instruksi_index']);
        Route::post('detail-resep', [ApotekerController::class, 'detail_resep_store']);
        // Route::get('dokter', [UserController::class, 'index']);
        Route::get('detail-resep', [ApotekerController::class, 'detail_resep_index']);
    });
    
    Route::middleware('role:dokterumum,laboran,resepsionis')->group(function () {
        Route::apiResource('/tindakan', TindakanController::class);
        Route::apiResource('jenis-pemeriksaan-lab', JenisPemeriksaanLabController::class);
        Route::apiResource('laboratorium', LaboratoriumController::class);
        Route::apiResource('permintaan-lab', PermintaanLabController::class);
    });
    
    Route::middleware('role:laboran')->group(function() {
        Route::apiResource('hasil-lab', HasilLabController::class);
    });
    
    // Route::middleware('role:apoteker')->group(function() {
    // });

});
