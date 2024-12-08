@extends('admin.layouts.main')

@section('content')
<div>
    <h3>Crear Categoría</h3>
    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>
        <div>
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion"></textarea>
        </div>
        <div>
            <label for="parent_id">Categoría Padre</label>
            <select name="parent_id" id="parent_id">
                <option value="">Sin padre</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Guardar</button>
    </form>
</div>
@endsection
