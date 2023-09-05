<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\V1\FileVerificationController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class,'logout']);

Route::middleware('auth:api')->group( function () {
    Route::prefix('v1')->group(function () {
        Route::post('/verifiable_file',[FileVerificationController::class,'verifyFile']);
        Route::get('/file_analysis',[FileVerificationController::class,'getAnalysisFile']);
    });
});