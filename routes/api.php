<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'
], function ($router) {
    Route::post('/auth', [App\Http\Controllers\AuthController::class, 'auth']);

    Route::middleware('auth:api')->group(function () {

        Route::get('/leads', [App\Http\Controllers\LeadController::class, 'index']);
        Route::post('/lead', [App\Http\Controllers\LeadController::class, 'create']);
        Route::get('/lead/{id}', [App\Http\Controllers\LeadController::class, 'get']);

        Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    });
});
