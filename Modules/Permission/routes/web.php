<?php

use Illuminate\Support\Facades\Route;
use Modules\Permission\Http\Controllers\PermissionController;

Route::middleware(['auth', 'verified'])->group(function () {

    #permission
    Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
    Route::post('/permission/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('/permission/update/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/permission/delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete');
    Route::get('/permission/{id}/restore', [PermissionController::class, 'restore'])->name('permission.restore');

    #common
    Route::get('/searchModule', function(){

    })->name('searchModule');
    Route::get('/searchRole', function(){

    })->name('searchRole');
    Route::get('/searchCompany', function(){

    })->name('searchCompany');
    Route::get('/searchSource', function(){

    })->name('searchSource');
    Route::get('/searchStage', function(){

    })->name('searchStage');
});
