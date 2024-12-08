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
    <h1>Crear Nuevo Usuario</h1>
    
    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario para crear un usuario -->
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>
 <div class="form-group">
            <label for="role">Rol</label>
            <select class="form-control" name="role" id="role">
                <option value="admin">Administrador</option>
                <option value="user">Usuario</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar Usuario</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection
