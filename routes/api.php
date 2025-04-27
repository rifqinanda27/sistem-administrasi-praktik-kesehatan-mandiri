<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\VisitController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);

    // Route::middleware('role:admin')->group(function () {
    //     Route::get('/dashboard', [AdminController::class, 'dashboard']);
    // });

    // Route::prefix('user')->middleware('role:user')->group(function () {
    //     Route::get('/profile', [UserController::class, 'profile']);
    // });
    Route::middleware('role:admin')->group(function () {
        // Manajemen User
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    
        // Manajemen Role
        Route::get('/roles', [RoleController::class, 'index']);
        Route::post('/roles', [RoleController::class, 'store']);
        Route::delete('/roles/{id}', [RoleController::class, 'destroy']);
    });

    Route::middleware('role:resepsionis')->group(function () {
        Route::get('/pasien', [PatientController::class, 'index']);
        Route::post('/pasien', [PatientController::class, 'store']);
        Route::get('/pasien/{id}', [PatientController::class, 'show']);
        Route::put('/pasien/{id}', [PatientController::class, 'update']);
        Route::delete('/pasien/{id}', [PatientController::class, 'destroy']);
    });

    Route::middleware('role.resepsionis')->group(function () {
        Route::get('/kunjungan', [VisitController::class, 'index']);
        Route::post('/kunjungan', [VisitController::class, 'store']);
        Route::get('/kunjungan/{id}', [VisitController::class, 'show']);
        Route::put('/kunjungan/{id}', [VisitController::class, 'update']);
        Route::delete('/kunjungan/{id}', [VisitController::class, 'destroy']);
    });
    
});
