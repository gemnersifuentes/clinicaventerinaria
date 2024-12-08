


<!-- resources/views/admin/productosvariantes/index.blade.php -->

@extends('admin.layouts.main')

@section('content')
    <h1>Variaciones del Producto: {{ $producto->nombre }}</h1>

    <a href="{{ route('productosvariantes.create', $producto->id) }}" class="btn btn-primary mb-3">Agregar Variación</a>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>  <!-- Nueva columna para el nombre del producto -->
                <th>Talla</th>
                <th>Color</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($variaciones as $variacion)
                <tr>
                    <td>{{ $producto->nombre }}</td>  <!-- Mostrar el nombre del producto en cada fila -->
                    <td>{{ $variacion->talla }}</td>
                    <td>{{ $variacion->color }}</td>
                    <td>{{ $variacion->precio }}</td>
                    <td>{{ $variacion->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
