<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategorijaController;
use App\Http\Controllers\TransakcijaController;
use App\Http\Controllers\LimitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\IsAdmin;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Kategorije
    Route::get('/kategorije', [KategorijaController::class, 'index']);
    Route::get('/kategorije/{id}', [KategorijaController::class, 'show']);
    
    Route::middleware(IsAdmin::class)->group(function () {
        Route::apiResource('kategorije', KategorijaController::class)->except(['index', 'show']);
    });

    // Transakcije
    Route::get('/transakcije', [TransakcijaController::class, 'index']);
    Route::post('/transakcije', [TransakcijaController::class, 'store']);
    Route::get('/transakcije/filter', [TransakcijaController::class, 'filter']);
    Route::delete('/transakcije/{id}', [TransakcijaController::class, 'destroy']);

    Route::apiResource('limiti', LimitController::class)->except(['create', 'edit']);
});
