@extends('admin.layouts.main') <!-- Si estás utilizando un layout principal -->

@section('content')
    <div class="container">
        <h1>Lista de Productos</h1>
        
        <!-- Tabla para mostrar los productos -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Imágenes</th>
                    <th>Stock</th>
                    <th>Condición</th>
                    <th>Estado</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>Categoría</th>
                    <th>Marca</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->Codigo }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>
                            @if ($producto->imagenes)
                                @php
                                    $imagenes = json_decode($producto->imagenes, true);
                                @endphp
                                <img src="{{ asset('storage/' . $imagenes[0]) }}" width="100px" alt="Imagen del producto">
                            @else
                                <span>No hay imagen</span>
                            @endif
                        </td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->condicion }}</td>
                        <td>{{ $producto->estado }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->descuento }}%</td>
                        <td>{{ $producto->categoria->nombre }}</td> <!-- Relación con Categoría -->
                        <td>{{ $producto->marca->nombre ?? 'No asignada' }}</td> <!-- Relación con Marca (puede ser nula) -->
                        <td>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Editar</a>
                            <!-- Botón para gestionar tallas, solo si es un producto de categoría 'Ropa' -->
                            @if ($producto->categoria->nombre === 'Ropa')
                                <a href="{{ route('productos.manageTallas', $producto->id) }}" class="btn btn-info btn-sm">Gestionar Tallas</a> <!-- Botón para gestionar tallas -->
                            @endif
                            
                            <!-- Botón para eliminar producto -->
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <a href="{{ route('productos.create') }}" class="btn btn-primary">Agregar Producto</a>
        
    </div>
@endsection
