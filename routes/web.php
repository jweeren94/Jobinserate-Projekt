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

Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);


//create, read, update für User
Route::get('/konto', function () {
    return view('konto');
})->middleware('auth');

Route::post('/register', [UserController::class, 'register']);
Route::put('/updateUser', [UserController::class, 'update'])->middleware('auth');

//create, update für Company
Route::put('/updateCompany', [CompanyController::class, 'update'])->middleware('auth');
Route::post('/createCompany', [CompanyController::class, 'createCompany'])->middleware('auth');
