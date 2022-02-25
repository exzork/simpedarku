<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->name('api.')->group(function(){
    Route::apiResource('reports',\App\Http\Controllers\Api\V1\ReportController::class);
    Route::get('/user/profile',[\App\Http\Controllers\Api\V1\UserController::class,'profile'])->name('user.profile.show');
    Route::put('/user/profile',[\App\Http\Controllers\Api\V1\UserController::class,'updateProfile'])->name('user.profile.update');
    Route::apiResource('users',\App\Http\Controllers\Api\V1\UserController::class);

});
