@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1>Editar Producto</h1>

        <!-- Mostrar mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario de edición -->
        <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Método PUT para actualizar el producto -->

            <div class="form-group">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="Codigo">Código del Producto</label>
                <input type="text" class="form-control @error('Codigo') is-invalid @enderror" id="Codigo" name="Codigo" value="{{ old('Codigo', $producto->Codigo) }}" required>
                @error('Codigo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea>
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
                @if ($producto->imagenes)
                    <div class="mt-2">
                        <h5>Imágenes actuales:</h5>
                        <ul>
                            @foreach (json_decode($producto->imagenes) as $imagen)
                                <li><img src="{{ asset('storage/' . $imagen) }}" width="100px" alt="Imagen del producto"></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $producto->stock) }}">
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="condicion">Condición</label>
                <select class="form-control @error('condicion') is-invalid @enderror" id="condicion" name="condicion" required>
                    <option value="normal" {{ old('condicion', $producto->condicion) == 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="neevo" {{ old('condicion', $producto->condicion) == 'neevo' ? 'selected' : '' }}>Nuevo</option>
                </select>
                @error('condicion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                    <option value="activo" {{ old('estado', $producto->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado', $producto->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="text" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}">
                @error('precio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="descuento">Descuento</label>
                <input type="number" step="0.01" class="form-control @error('descuento') is-invalid @enderror" id="descuento" name="descuento" value="{{ old('descuento', $producto->descuento) }}">
                @error('descuento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoría</label>
                <select class="form-control @error('categoria_id') is-invalid @enderror" id="categoria_id" name="categoria_id" required>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="marca_id">Marca</label>
                <select class="form-control @error('marca_id') is-invalid @enderror" id="marca_id" name="marca_id">
                    <option value="">Seleccione una marca</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}" {{ old('marca_id', $producto->marca_id) == $marca->id ? 'selected' : '' }}>{{ $marca->marca }}</option>
                    @endforeach
                </select>
                @error('marca_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </form>
    </div>
@endsection
