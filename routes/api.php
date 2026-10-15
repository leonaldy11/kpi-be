<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KpiControllers;
 


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('kpi')->group(function () {
    Route::get('/index', [KpiControllers::class, 'index']);
    Route::post('/store', [KpiControllers::class, 'store']);
    Route::get('/show/{id}', [KpiControllers::class, 'show']);
    Route::put('/update/{id}', [KpiControllers::class, 'update']);
    Route::delete('/delete/{id}', [KpiControllers::class, 'delete']);
});

