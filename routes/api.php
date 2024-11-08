<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Middleware\JWTMiddleware;

Route::group(['middleware' => JWTMiddleware::class], function(){
    Route::get('/me', [AuthController::class, 'me']);
});
Route::group(['prefix' => 'company'], function(){
    Route::post('/register', [AuthController::class, 'registerCompany'])->middleware('guest');
});
Route::group(['prefix' => 'candidat'], function(){
    Route::post('/register', [AuthController::class, 'registerCandidat'])->middleware('guest');
});
Route::post('/login', [AuthController::class, 'login']);
