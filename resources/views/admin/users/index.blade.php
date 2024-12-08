@extends('admin.layouts.main')
<style>
    /* Estilo de la barra de desplazamiento */
::-webkit-scrollbar {
    width: 0px; /* Ancho de la barra */
    height: 10px; /* Alto para barras horizontales */
}

/* Fondo de la barra de desplazamiento */
::-webkit-scrollbar-track {
    background: #f0f0f0; /* Color del fondo de la barra */
    border-radius: 5px; /* Bordes redondeados */
}

/* Color del deslizador (scroll thumb) */
::-webkit-scrollbar-thumb {
    background: #e6e6e6; /* Color del deslizador */
    border-radius: 5px; /* Bordes redondeados */
}

/* Color del deslizador al pasar el mouse por encima */
::-webkit-scrollbar-thumb:hover {
    background: #d1d1d1; /* Color más oscuro en hover */
}

/* Opcional: color del borde del deslizador */
::-webkit-scrollbar-thumb:active {
    background: #bdbdbd; /* Color al hacer clic */
}

/* Estilo para navegadores que no usan WebKit */


</style>
@section('content')
<div class="container">
    <h1>Lista de Usuarios</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Crear Usuario</a>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
