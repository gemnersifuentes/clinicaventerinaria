@extends('admin.layouts.main')

@section('content') <!-- Aquí se inicia la sección -->

<h2>Gestionar Tallas para: {{ $producto->nombre }}</h2>

<h3>Tallas Actuales</h3>
<table>
    <thead>
        <tr>
            <th>Talla</th>
            <th>Precio</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        @foreach($producto->tallas as $talla)
        <tr>
            <td>{{ $talla->nombre }}</td>  <!-- Nombre de la talla -->
            <td>{{ $talla->pivot->precio }}</td>  <!-- Precio asociado -->
            <td>{{ $talla->pivot->stock }}</td>   <!-- Stock asociado -->
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Agregar Nuevas Tallas</h3>
<form action="{{ route('productos.updateTallas', $producto->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div id="nuevas-tallas">
        <div class="talla-item">
            <select name="tallas[0][id]" required>
                <option value="" disabled selected>Seleccionar Talla</option>
                @foreach($tallas as $talla)
                    <option value="{{ $talla->id }}">{{ $talla->nombre }}</option>
                @endforeach
            </select>
            <input type="number" name="tallas[0][precio]" placeholder="Precio" required>
            <input type="number" name="tallas[0][stock]" placeholder="Stock" required>
        </div>
    </div>

    <button type="submit">Actualizar Tallas</button>
</form>

<script>
function agregarTalla() {
    const container = document.getElementById('nuevas-tallas');
    const index = container.children.length;

    const html = `
    <div class="talla-item">
        <select name="tallas[${index}][id]" required>
            <option value="" disabled selected>Seleccionar Talla</option>
            @foreach($tallas as $talla)
                <option value="{{ $talla->id }}">{{ $talla->nombre }}</option>
            @endforeach
        </select>
        <input type="number" name="tallas[${index}][precio]" placeholder="Precio" required>
        <input type="number" name="tallas[${index}][stock]" placeholder="Stock" required>
    </div>`;
    
    container.insertAdjacentHTML('beforeend', html);
}
</script>

@endsection <!-- Aquí se cierra la sección -->
