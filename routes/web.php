<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EmployeeController::class, 'index']);
Route::post('/store', [EmployeeController::class, 'store'])->name('store');
Route::get('/fetch-all', [EmployeeController::class, 'fetchAll'])->name('fetchAll');
//Route::get('/edit', [EmployeeController::class, 'edit'])->name('edit');
Route::get('/edit', [EmployeeController::class, 'edit'])->name('edit');
Route::post('/update', [EmployeeController::class, 'update'])->name('update');
Route::post('/delete', [EmployeeController::class, 'delete'])->name('delete');
