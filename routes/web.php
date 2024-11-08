<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\JWTMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => JWTMiddleware::class], function(){
    Route::get('/me', [AuthController::class, 'me']);
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);