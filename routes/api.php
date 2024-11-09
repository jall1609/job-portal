<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Middleware\JWTMiddleware;

Route::group(['middleware' => JWTMiddleware::class], function(){
    Route::post('/me', [AuthController::class, 'me']);
});
Route::group(['prefix' => 'company'], function(){
});
Route::group(['prefix' => 'candidat'], function(){
});
Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function(){
    Route::post('/register-company', [AuthController::class, 'registerCandidat'])->middleware('guest');
    Route::post('/register-candidat', [AuthController::class, 'registerCompany'])->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
});
Route::get('/qq', [AuthController::class, 'qq']);
