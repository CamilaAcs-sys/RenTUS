<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

// 🏠 HOME – muestra máximo 9 propiedades
Route::get('/', [PropertyController::class, 'home'])->name('home.index');

// 🧱 CRUD completo de propiedades (para administrar)
Route::resource('properties', PropertyController::class)->except(['show']);

// 👁️ Ruta para mostrar detalle de una propiedad (fuera del resource por claridad)
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');
// 📄 Página "Sobre nosotros
Route::view('/about', 'about.index')->name('about.index');
