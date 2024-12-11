<!-- resources/views/components/arbol-categorias.blade.php -->
<div class="filtro-categorias">
    <h3>Categorías</h3>
    <div id="categoria-container">
        @include('components.categorias-recursivo', ['categorias' => $categorias])
    </div>
</div>

<!-- resources/views/components/categorias-recursivo.blade.php -->
@foreach($categorias as $categoria)
    <div class="categoria-item">
        <label>
            <input type="checkbox" 
                   name="categorias[]" 
                   value="{{ $categoria->id }}" 
                   class="categoria-checkbox"
                   data-parent="{{ $categoria->parent_id }}"
            > 
            {{ $categoria->nombre }}
        </label>
        
        @if($categoria->childrenRecursive->count() > 0)
            <div class="subcategorias" style="margin-left: 20px;">
                @include('components.categorias-recursivo', ['categorias' => $categoria->childrenRecursive])
            </div>
        @endif
    </div>
@endforeach

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Manejar lógica de selección de categorías
    const checkboxes = document.querySelectorAll('.categoria-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Si se marca un padre, marcar todos los hijos
            const subcategorias = this.closest('.categoria-item')
                .querySelectorAll('.subcategorias .categoria-checkbox');
            
            subcategorias.forEach(subcheckbox => {
                subcheckbox.checked = this.checked;
            });

            // Filtrar productos
            filtrarProductos();
        });
    });

    function filtrarProductos() {
        const categoriasSeleccionadas = Array.from(
            document.querySelectorAll('.categoria-checkbox:checked')
        ).map(cb => cb.value);

        const productos = document.querySelectorAll('.producto');
        
        productos.forEach(producto => {
            const categoriaProducto = producto.dataset.categoriaId;
            
            if (categoriasSeleccionadas.length === 0 || 
                categoriasSeleccionadas.includes(categoriaProducto)) {
                producto.style.display = 'block';
            } else {
                producto.style.display = 'none';
            }
        });
    }
});
</script>

<style>
.filtro-categorias {
    background-color: #f4f4f4;
    padding: 15px;
    border-radius: 5px;
}

.categoria-item {
    margin-bottom: 10px;
}

.subcategorias {
    margin-top: 5px;
}
</style>