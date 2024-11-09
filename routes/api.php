<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Middleware\CandidatMiddleware;
use App\Http\Middleware\CompanyMiddleware;
use App\Http\Middleware\JWTMiddleware;
use App\Models\JobVacancy;

Route::group(['middleware' => JWTMiddleware::class], function(){
    Route::post('/me', [AuthController::class, 'me']);
});
Route::group(['prefix' => 'company', 'middleware' => [JWTMiddleware::class, CompanyMiddleware::class ]], function(){
    Route::apiResource('job-vacancy', JobVacancyController::class);
    Route::get('job-vacancy/{jobVacancy}/applicant', [ApplicationController::class, 'getApplicantByJob']);
    Route::post('job-vacancy/{jobVacancy}/applicant/{candidat}/change-status', [ApplicationController::class, 'changeStatusCandidat']);
});
Route::group(['prefix' => 'candidat', 'middleware' => [JWTMiddleware::class, CandidatMiddleware::class ]], function(){
    Route::get('my-application', [ApplicationController::class, 'getMyApplication']);
});
Route::group(['prefix' => 'job-list'], function(){
    Route::get('/', [JobVacancyController::class, 'index']);
    Route::get('/{jobVacancy}', [JobVacancyController::class, 'show']);
    Route::post('/{jobVacancy}/apply', [ApplicationController::class, 'apply'])->middleware(CandidatMiddleware::class);
});
Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function(){
    Route::post('/register-company', [AuthController::class, 'registerCompany'])->middleware('guest');
    Route::post('/register-candidat', [AuthController::class, 'registerCandidat'])->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
});
