<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoVariacionController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin', function () {
    if (Auth::check()) {
        return view('admin.dashboard'); // La vista que quieres mostrar para los administradores
    } else {
        return view('auth.login'); // Redirigir a la vista de login si no está autenticado
    }
});
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('categorias', CategoriaController::class);
    Route::resource('productos', ProductoController::class);
   // Ruta para gestionar tallas del producto
Route::get('productos/{id}/tallas', [ProductoController::class, 'manageTallas'])->name('productos.manageTallas');
// Ruta para actualizar las tallas de un producto
Route::put('productos/{productoId}/tallas', [ProductoController::class, 'updateTallas'])->name('productos.updateTallas');

});


Route::get('/socoobydoo', function () {
    return view('scoobydoo.index'); // Especifica la carpeta 'scoobydoo' y luego el archivo 'index'
});
