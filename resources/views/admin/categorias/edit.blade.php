@extends('admin.layouts.main')

@section('content')
<div>
    <h3>Editar Categoría</h3>
    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $categoria->nombre) }}" required>
        </div>
        <div>
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion">{{ old('descripcion', $categoria->descripcion) }}</textarea>
        </div>
        <div>
            <label for="parent_id">Categoría Padre</label>
            <select name="parent_id" id="parent_id">
                <option value="">Sin padre</option>
                @foreach ($categorias as $cat)
                    <option value="{{ $cat->id }}" 
                        {{ $cat->id == $categoria->parent_id ? 'selected' : '' }}>
                        {{ $cat->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Actualizar</button>
    </form>
</div>
@endsection
