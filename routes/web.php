<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoriaController;


use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoVariacionController;



use App\Http\Controllers\MarcaController;








Route::get('/', function () {
    return redirect('/scoobydoo');
   
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
    Route::resource('marcas', MarcaController::class);
    Route::resource('productos', ProductoController::class);

    Route::get('productos/{id}/tallas', [ProductoController::class, 'manageTallas'])->name('productos.manageTallas');
    // Ruta para actualizar las tallas de un producto
    Route::put('productos/{productoId}/tallas', [ProductoController::class, 'updateTallas'])->name('productos.updateTallas');
    Route::delete('productos/{producto}/tallas/{talla}', [ProductoController::class, 'deleteTalla'])->name('productos.deleteTalla');

    
});


Route::get('/scoobydoo', function () {
    return view('scoobydoo.index'); // Laravel busca en resources/views/scoobydoo/index.blade.php
});
Route::prefix('scoobydoo')->group(function () {
 
    Route::get('productos/search', [\App\Http\Controllers\Tienda\ProductoController::class, 'search'])->name('productos.search');

   
    Route::get('productos', [\App\Http\Controllers\Tienda\ProductoController::class, 'index'])->name('scoobydoo.productos.index');
  
    // Ruta para el detalle de un producto
    Route::get('productos/{id}', [\App\Http\Controllers\Tienda\ProductoController::class, 'show'])->name('productos.show');
      // Ruta para agregar productos al carrito
      Route::get('cart/add/{id}', [\App\Http\Controllers\Tienda\CartController::class, 'addToCart'])->name('cart.add');

      // Ruta para mostrar el carrito
      Route::get('cart', [\App\Http\Controllers\Tienda\CartController::class, 'showCart'])->name('cart.show');
  
      // Ruta para eliminar productos del carrito
      Route::get('cart/remove/{id}', [\App\Http\Controllers\Tienda\CartController::class, 'removeFromCart'])->name('cart.remove');
  
      // Ruta para actualizar la cantidad de un producto en el carrito
      Route::post('cart/update/{id}', [\App\Http\Controllers\Tienda\CartController::class, 'updateCart'])->name('cart.update');
});

