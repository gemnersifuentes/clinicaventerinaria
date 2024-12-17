<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspecialidadController;

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



Route::get('/Especialidades', [EspecialidadController::class, 'index'])->name('Especialidades.index');
Route::get('/Especialidades/create', [EspecialidadController::class, 'create'])->name('Especialidades.create');
Route::post('/Especialidades', [EspecialidadController::class, 'store'])->name('Especialidades.store');
Route::get('/Especialidades/{Especialidad}/edit', [EspecialidadController::class, 'edit'])->name('Especialidades.edit');
Route::put('/Especialidades/{Especialidad}', [EspecialidadController::class, 'update'])->name('Especialidades.update');
Route::delete('/Especialidades/{Especialidad}', [EspecialidadController::class, 'destroy'])->name('Especialidades.destroy');