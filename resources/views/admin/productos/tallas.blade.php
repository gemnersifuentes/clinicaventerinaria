@extends('admin.layouts.main')

@section('content') <!-- Aquí se inicia la sección -->

<h3>Tallas Actuales</h3>
<form action="{{ route('productos.updateTallas', $producto->id) }}" method="POST">
    @csrf
    @method('PUT')

    <table>
        <thead>
            <tr>
                <th>Talla</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($producto->tallas as $talla)
            <tr>
                <td>{{ $talla->nombre }}</td>
                <td>
                    <input type="number" name="tallas_existentes[{{ $talla->id }}][precio]" value="{{ $talla->pivot->precio }}" required>
                </td>
                <td>
                    <input type="number" name="tallas_existentes[{{ $talla->id }}][stock]" value="{{ $talla->pivot->stock }}" required>
                </td>
                <td>
                    <button type="button" class="btn-eliminar-talla" data-talla-id="{{ $talla->id }}">Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit">Actualizar Tallas Existentes</button>
</form>

<h3>Agregar Nuevas Tallas</h3>
<form action="{{ route('productos.updateTallas', $producto->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div id="nuevas-tallas">
        <div class="talla-item">
            <select name="tallas_nuevas[0][id]" required>
                <option value="" disabled selected>Seleccionar Talla</option>
                @foreach($tallas as $talla)
                    <option value="{{ $talla->id }}">{{ $talla->nombre }}</option>
                @endforeach
            </select>
            <input type="number" name="tallas_nuevas[0][precio]" placeholder="Precio" required>
            <input type="number" name="tallas_nuevas[0][stock]" placeholder="Stock" required>
        </div>
    </div>

    <button type="button" onclick="agregarTalla()">Agregar Otra Talla</button>
    <button type="submit">Guardar Nuevas Tallas</button>
</form>

<script>
    document.querySelectorAll('.btn-eliminar-talla').forEach(button => {
    button.addEventListener('click', function () {
        const tallaId = this.getAttribute('data-talla-id');
        if (confirm('¿Estás seguro de que deseas eliminar esta talla?')) {
            fetch(`/productos/${{{ $producto->id }}}/tallas/${tallaId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (response.ok) {
                    alert('Talla eliminada correctamente.');
                    location.reload();
                } else {
                    alert('Error al eliminar la talla.');
                }
            });
        }
    });
});

</script>

@endsection <!-- Aquí se cierra la sección -->
