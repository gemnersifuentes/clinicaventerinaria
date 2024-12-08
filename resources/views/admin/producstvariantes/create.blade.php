@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Crear Nueva Variación de Producto</h1>

    <!-- Formulario para agregar variaciones -->
    <div class="mb-3">
        <label for="product_id" class="form-label">Producto</label>
        <select id="product_id" class="form-select" required>
            <option value="">Seleccione un producto</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="size_id" class="form-label">Talla</label>
        <select id="size_id" class="form-select" required>
            <option value="">Seleccione una talla</option>
            @foreach ($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="number" id="precio" class="form-control" step="0.01" min="0" required>
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" id="stock" class="form-control" min="0" required>
    </div>

    <button type="button" class="btn btn-primary" id="add-variation">Agregar Variación</button>

    <!-- Tabla para mostrar las variaciones agregadas -->
    <h2 class="mt-4">Variaciones Agregadas</h2>
    <table class="table table-bordered" id="variations-table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Talla</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- Botón para guardar todas las variaciones -->
    <form action="{{ route('producstvariations.store') }}" method="POST" id="save-form">
        @csrf
        <input type="hidden" name="variations" id="variations-data">
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('producstvariations.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const variationsTable = document.querySelector('#variations-table tbody');
    const variationsDataInput = document.querySelector('#variations-data');
    const addVariationButton = document.querySelector('#add-variation');

    let variations = [];

    addVariationButton.addEventListener('click', function () {
        const productId = document.querySelector('#product_id').value;
        const productName = document.querySelector('#product_id option:checked').textContent;
        const sizeId = document.querySelector('#size_id').value;
        const sizeName = document.querySelector('#size_id option:checked').textContent;
        const price = document.querySelector('#precio').value;
        const stock = document.querySelector('#stock').value;

        // Validar que los campos estén llenos
        if (!productId || !sizeId || !price || !stock) {
            alert('Por favor, completa todos los campos antes de agregar.');
            return;
        }

        // Crear una nueva variación
        const newVariation = {
            product_id: productId,
            product_name: productName,
            size_id: sizeId,
            size_name: sizeName,
            precio: parseFloat(price),
            stock: parseInt(stock),
        };

        // Agregar la variación al arreglo
        variations.push(newVariation);

        // Actualizar la tabla
        updateTable();
    });

    function updateTable() {
        variationsTable.innerHTML = ''; // Limpiar tabla
        variations.forEach((variation, index) => {
            const row = `
                <tr>
                    <td>${variation.product_name}</td>
                    <td>${variation.size_name}</td>
                    <td>${variation.precio}</td>
                    <td>${variation.stock}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeVariation(${index})">Eliminar</button>
                    </td>
                </tr>
            `;
            variationsTable.insertAdjacentHTML('beforeend', row);
        });

        // Guardar las variaciones en el campo oculto
        variationsDataInput.value = JSON.stringify(variations);
    }

    // Eliminar variaciones
    window.removeVariation = function (index) {
        variations.splice(index, 1);
        updateTable();
    };
});

</script>
@endsection
