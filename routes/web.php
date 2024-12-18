<?php

use App\Http\Controllers\PedidoController;
use App\Models\Pedido;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
});

    Route::get('/pedidos',[PedidoController::class,'index'])->name('pedidos.index');
    Route::get('/pedidos/create',[PedidoController::class, 'create'])->name('pedidos.create');
    Route::post('/pedidos',[PedidoController::class,'store'])->name('pedidos.store');
    Route::get('/pedidos{pedido}/edit',[PedidoController::class,'edit'])->name('pedidos.edit');
    Route::put('/pedidos{pedido}',[PedidoController::class,'update'])->name('pedidos.update');
    Route::delete('pedidos{pedido}',[PedidoController::class,'destroy'])->name('pedidos.destroy');