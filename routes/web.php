<?php

use App\Http\Controllers\Datos_EmpresaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoriaController;


use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoVariacionController;



use App\Http\Controllers\MarcaController;
use App\Http\Controllers\Tienda\CarritoController;

use App\Http\Controllers\Auth\ClienteAuthController;





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
    Route::get('productos/{id}', [\App\Http\Controllers\Tienda\ProductoController::class, 'show'])->name('productos.show');

   

    Route::get('/cliente/registro', [ClienteAuthController::class, 'mostrarRegistro'])->name('scoobydoo.cliente.registro');
    Route::post('/cliente/registro', [ClienteAuthController::class, 'registrar'])->name('scoobydoo.cliente.registro');
    Route::get('/cliente/login', [ClienteAuthController::class, 'mostrarInicioSesion'])->name('scoobydoo.cliente.login');
    Route::post('/cliente/login', [ClienteAuthController::class, 'iniciarSesion'])->name('scoobydoo.cliente.login');

    Route::post('/cliente/logout', [ClienteAuthController::class, 'logout'])->name('scoobydoo.cliente.logout');


    Route::get('/cliente/mi-cuenta', [ClienteAuthController::class, 'miCuenta'])->name('scoobydoo.cliente.mi_cuenta');

    Route::get('terminos-y-condiciones', function () {
        return view('scoobydoo.terminos');
    })->name('terminos');
    
});

Route::resource('empresa', Datos_EmpresaController::class);