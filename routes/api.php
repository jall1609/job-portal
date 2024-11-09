<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Middleware\CompanyMiddleware;
use App\Http\Middleware\JWTMiddleware;
use App\Models\JobVacancy;

Route::group(['middleware' => JWTMiddleware::class], function(){
    Route::post('/me', [AuthController::class, 'me']);
});
Route::group(['prefix' => 'company', 'middleware' => [JWTMiddleware::class, CompanyMiddleware::class ]], function(){
    Route::apiResource('job-vacancy', JobVacancyController::class);
});
Route::group(['prefix' => 'candidat'], function(){
});
Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function(){
    Route::post('/register-company', [AuthController::class, 'registerCandidat'])->middleware('guest');
    Route::post('/register-candidat', [AuthController::class, 'registerCompany'])->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
});
Route::get('/job-list', [JobVacancyController::class, 'index']);
Route::get('/job-list/{jobVacancy}', [JobVacancyController::class, 'show']);
