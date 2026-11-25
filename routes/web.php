<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\CompanyController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/loginRegister', function () {
    return view('loginRegister');
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);
