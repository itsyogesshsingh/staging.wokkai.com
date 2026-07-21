<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::middleware(['auth', 'verified'])->group(function () {
    #users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{uid}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{uid}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/delete/{uid}', [UserController::class, 'delete'])->name('users.delete');
});

