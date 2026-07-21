<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
use Core\Http\Controllers\BaseController;
use Modules\Auth\Http\Controllers\AuthController;



Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    #module
    Route::get('/module', [ModuleController::class, 'index'])->name('module.index');
    Route::post('/module/store', [ModuleController::class, 'store'])->name('module.store');
    Route::get('/module/edit/{module_id}', [ModuleController::class, 'edit'])->name('module.edit');
    Route::put('/module/update/{module_id}', [ModuleController::class, 'update'])->name('module.update');
    Route::delete('/module/delete/{module_id}', [ModuleController::class, 'delete'])->name('module.delete');


    # core
    Route::get('/searchModule', [BaseController::class, 'searchModule'])->name('searchModule');
    Route::get('/searchRole', [BaseController::class, 'searchRole'])->name('searchRole');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
