@extends('scoobydoo.layouts.main')

@section('content')
<div class="container mx-auto my-10 p-5 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-5">Mi Cuenta</h1>

    <div class="mb-5">
        <label class="block font-medium text-gray-700">Nombre:</label>
        <p class="border border-gray-300 p-2 rounded-md">{{ $cliente->nombre }}</p>
    </div>

    <div class="mb-5">
        <label class="block font-medium text-gray-700">Correo Electrónico:</label>
        <p class="border border-gray-300 p-2 rounded-md">{{ $cliente->email }}</p>
    </div>

    @if($cliente->telefono)
        <div class="mb-5">
            <label class="block font-medium text-gray-700">Teléfono:</label>
            <p class="border border-gray-300 p-2 rounded-md">{{ $cliente->telefono }}</p>
        </div>
    @endif

    <div class="mt-5">
        <a href="" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Editar Información</a>
    </div>
</div>
@endsection
