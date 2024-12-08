@extends('admin.layouts.main')

@section('content')
<div class="container">
    <h1>Editar Variaciones de Producto</h1>

    <!-- Tabla para listar las variaciones -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Talla</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($variations as $variation)
            <tr>
                <td>{{ $variation->id }}</td>
                <td>{{ $variation->product->nombre }}</td>
                <td>{{ $variation->size->nombre }}</td>
                <td>{{ $variation->precio }}</td>
                <td>{{ $variation->stock }}</td>
                <td>
                    <button class="btn btn-warning btn-edit" 
                        data-id="{{ $variation->id }}" 
                        data-product-id="{{ $variation->product_id }}"
                        data-size-id="{{ $variation->size_id }}" 
                        data-precio="{{ $variation->precio }}" 
                        data-stock="{{ $variation->stock }}">Editar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Formulario para editar una variación -->
    <div class="mt-4">
        <h2>Editar Variación</h2>
        <form id="variation-form" method="POST" action="{{ route('producstvariations.update', $productVariation->id) }}">
            @csrf
            @method('PUT')

            <input type="hidden" name="variation_id" id="variation_id">

            <div class="mb-3">
                <label for="product_name" class="form-label">Producto</label>
                <input type="text" id="product_name" class="form-control" value="{{ $productVariation->product->nombre }}" readonly>
                <input type="hidden" name="product_id" value="{{ $productVariation->product_id }}">
            </div>
            
            <div class="mb-3">
                <label for="size_id" class="form-label">Talla</label>
                <select name="size_id" id="size_id" class="form-select" required>
                    <option value="">Seleccione una talla</option>
                    @foreach ($sizes as $size)
                        <option value="{{ $size->id }}" {{ $size->id == $productVariation->size_id ? 'selected' : '' }}>{{ $size->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" name="precio" id="precio" class="form-control" step="0.01" min="0" value="{{ $productVariation->precio }}" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" min="0" value="{{ $productVariation->stock }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.btn-edit');
    const form = document.getElementById('variation-form');
    const variationIdField = document.getElementById('variation_id');
    const productIdField = document.querySelector('input[name="product_id"]');
    const sizeIdField = document.getElementById('size_id');
    const precioField = document.getElementById('precio');
    const stockField = document.getElementById('stock');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const variationId = button.getAttribute('data-id');
            const productId = button.getAttribute('data-product-id');
            const sizeId = button.getAttribute('data-size-id');
            const precio = button.getAttribute('data-precio');
            const stock = button.getAttribute('data-stock');

            if (variationId && productId && sizeId && precio !== null && stock !== null) {
                // Rellenar los campos del formulario
                variationIdField.value = variationId;
                productIdField.value = productId;
                sizeIdField.value = sizeId;
                precioField.value = precio;
                stockField.value = stock;

                // Ajustar dinámicamente la acción del formulario
                form.action = `{{ route('producstvariations.update', '') }}/${variationId}`;
            } else {
                alert("Error: Datos no disponibles para la variación seleccionada.");
            }
        });
    });
});
</script>
@endsection
