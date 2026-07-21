<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;


#login
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/doLogin', [AuthController::class, 'doLogin'])->name('doLogin');
