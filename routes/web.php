<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/properties', [PropertyController::class, 'index'])->name('properties');
Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
Route::get('/properties/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
Route::put('/properties/{id}', [PropertyController::class, 'update'])->name('properties.update');
Route::delete('/properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');
