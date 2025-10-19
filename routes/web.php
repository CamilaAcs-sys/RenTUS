<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PropertyController::class, 'index'])->name('home.index');

//resource agrega todos los demas metodos (create, store, show, edit, update, destroy):
Route::resource('properties', PropertyController::class);