<?php

use Illuminate\Support\Facades\Route;
use Modules\Role\Http\Controllers\RoleController;

Route::middleware(['auth', 'verified'])->group(function () {

    #roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');
    Route::get('/roles/{id}/restore', [RoleController::class, 'restore'])->name('roles.restore');
    Route::get('/getPermissions', [RoleController::class, 'getPermissions'])->name('getPermissions');
});
