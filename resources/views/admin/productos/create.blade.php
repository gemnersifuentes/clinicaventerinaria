@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1>Crear Nuevo Producto</h1>

        <!-- Mostrar mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario de creación -->
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="Codigo">Código del Producto</label>
                <input type="text" class="form-control @error('Codigo') is-invalid @enderror" id="Codigo" name="Codigo" value="{{ old('Codigo') }}" required>
                @error('Codigo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="imagenes">Imágenes</label>
                <input type="file" class="form-control @error('imagenes') is-invalid @enderror" id="imagenes" name="imagenes[]" multiple>
                @error('imagenes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}">
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="condicion">Condición</label>
                <select class="form-control @error('condicion') is-invalid @enderror" id="condicion" name="condicion" required>
                    <option value="normal" {{ old('condicion') == 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="neevo" {{ old('condicion') == 'neevo' ? 'selected' : '' }}>Nuevo</option>
                </select>
                @error('condicion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="text" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio') }}">
                @error('precio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="descuento">Descuento</label>
                <input type="number" step="0.01" class="form-control @error('descuento') is-invalid @enderror" id="descuento" name="descuento" value="{{ old('descuento') }}">
                @error('descuento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoría</label>
                <select class="form-control @error('categoria_id') is-invalid @enderror" id="categoria_id" name="categoria_id" required>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="marca_id">Marca</label>
                <select name="marca_id" id="marca_id" class="form-control">
                    <option value="">Selecciona una marca</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}" {{ old('marca_id') == $marca->id ? 'selected' : '' }}>
                            {{ $marca->marca }}
                        </option>
                    @endforeach
                </select>
                
                
                @error('marca_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Guardar Producto</button>
        </form>
    </div>
@endsection
