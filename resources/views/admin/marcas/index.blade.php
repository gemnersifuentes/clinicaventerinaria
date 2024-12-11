<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('admin.layouts.main') <!-- Si estás utilizando un layout principal -->

@section('content')
    <div class="container">
    <h1>Marcas</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marcas as $marca)
                <tr>
                    <td>{{ $marca->marca }}</td>
                    <td>
                        <a href="{{ route('marcas.edit', $marca->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('marcas.destroy', $marca->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta marca?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('marcas.create') }}" class="btn btn-primary">Agregar Marca</a>
    </div>
    @endsection
    
</body>
</html>