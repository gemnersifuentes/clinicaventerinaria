<div class="w-full md:w-1/4 px-4 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Filtros</h2>
        <div>
            <button 
                class="bg-indigo-600 text-white px-4 py-2 rounded-50 hover:bg-indigo-700 transition-colors w-full mb-2">
                Todos
            </button>
        </div>
        <div class="mb-6">
            <button id="categoriesToggle" class="flex items-center justify-between w-full text-left text-lg font-medium text-gray-700 hover:text-indigo-600 transition-colors">
                <span>Categorías</span>
                <svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="categoriesList" class="mt-3 hidden space-y-2">
                @foreach($categorias as $categoria)
                <label class="flex items-center space-x-3 text-gray-600 hover:text-indigo-600 cursor-pointer transition-colors">
                    <input 
                        type="checkbox" 
                        name="categories[]" 
                        value="{{ $categoria->id }}" 
                        class="category-checkbox form-checkbox text-indigo-600 rounded"
                        {{ in_array($categoria->id, $selectedCategories ?? []) ? 'checked' : '' }}
                    >
                    <span>{{ $categoria->nombre }}</span>
                </label>
                @endforeach
            </div>
        </div>
        <div class="mb-6">
            <button id="categoriesToggle2" class="flex items-center justify-between w-full text-left text-lg font-medium text-gray-700 hover:text-indigo-600 transition-colors">
                <span>Marcas</span>
                <svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="categoriesList2" class="mt-3 hidden space-y-2">
                @foreach($marcas as $marca)
                <label class="flex items-center space-x-3 text-gray-600 hover:text-indigo-600 cursor-pointer transition-colors">
                    <input type="checkbox" class="brand-checkbox form-checkbox text-indigo-600 rounded" value="{{ $marca->id }}">
                    <span>{{ $marca->marca }}</span>
                </label>
                @endforeach
            </div>
        </div>
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-700 mb-3">Tallas</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($tallas as $talla)
                <label class="size-checkbox">
                    <input type="checkbox" class="hidden peer" value="{{ $talla->id }}">
                    <span class="inline-flex items-center justify-center w-10 h-10 text-gray-700 peer-checked:text-white bg-white peer-checked:bg-indigo-600 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-100 transition-colors">{{ $talla->nombre }}</span>
                </label>
                @endforeach
            </div>
        </div>
        <div>
            <h3 class="text-lg font-medium text-gray-700 mb-3">Precio</h3>
            <div class="flex items-center space-x-4">
                <input type="number" id="minPrice" placeholder="Min" class="w-20 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <span class="text-gray-500">-</span>
                <input type="number" id="maxPrice" placeholder="Max" class="w-20 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <input type="range" min="0" max="1000" step="10" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer mt-4" id="priceRange">
            <div class="flex justify-between mt-2 text-sm text-gray-600">
                <span>$0</span>
                <span id="priceValue" class="font-medium text-indigo-600">$500</span>
                <span>$1000</span>
            </div>
            <button id="applyPriceFilter" class="w-full bg-indigo-600 text-white py-2 mt-4 rounded-md hover:bg-indigo-700 transition-colors">
                Filtrar por Precio
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
        const brandCheckboxes = document.querySelectorAll('.brand-checkbox');
        const sizeCheckboxes = document.querySelectorAll('.size-checkbox input');
        const minPriceInput = document.getElementById('minPrice');
        const maxPriceInput = document.getElementById('maxPrice');
        const priceRangeInput = document.getElementById('priceRange');
        const applyPriceFilterButton = document.getElementById('applyPriceFilter');

        // Función para aplicar filtros
        function applyFilters() {
            const selectedCategories = Array.from(categoryCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
            const selectedBrands = Array.from(brandCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
            const selectedSizes = Array.from(sizeCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
            const minPrice = minPriceInput.value || '';
            const maxPrice = maxPriceInput.value || '';
    
            const baseUrl = window.location.pathname;
            const params = new URLSearchParams(window.location.search);
    
            // Limpiamos los filtros previos en la URL
            params.delete('categories[]');
            params.delete('brands[]');
            params.delete('tallas[]');
            params.delete('minPrice');
            params.delete('maxPrice');
    
            // Agregamos los filtros seleccionados
            if (selectedCategories.length > 0) {
                selectedCategories.forEach(catId => params.append('categories[]', catId));
            }
    
            if (selectedBrands.length > 0) {
                selectedBrands.forEach(brandId => params.append('brands[]', brandId));
            }
    
            if (selectedSizes.length > 0) {
                selectedSizes.forEach(sizeId => params.append('tallas[]', sizeId));
            }
    
            // Solo agregamos los parámetros de precio si se han especificado
            if (minPrice && minPrice !== "") {
                params.set('minPrice', minPrice);
            }
            if (maxPrice && maxPrice !== "") {
                params.set('maxPrice', maxPrice);
            }
    
            // Redirigimos a la nueva URL con los parámetros seleccionados
            window.location.href = `${baseUrl}?${params.toString()}`;
        }

        // Función para mantener los checkboxes seleccionados en la recarga de página
        function setSelectedFilters() {
            const params = new URLSearchParams(window.location.search);

            // Mantener las categorías seleccionadas
            const selectedCategories = params.getAll('categories[]');
            categoryCheckboxes.forEach(cb => {
                cb.checked = selectedCategories.includes(cb.value);
            });

            // Mantener las marcas seleccionadas
            const selectedBrands = params.getAll('brands[]');
            brandCheckboxes.forEach(cb => {
                cb.checked = selectedBrands.includes(cb.value);
            });

            // Mantener las tallas seleccionadas
            const selectedSizes = params.getAll('tallas[]');
            sizeCheckboxes.forEach(cb => {
                cb.checked = selectedSizes.includes(cb.value);
            });

            // Mantener los valores de precio
            const minPrice = params.get('minPrice') || '';
            const maxPrice = params.get('maxPrice') || '';
            minPriceInput.value = minPrice;
            maxPriceInput.value = maxPrice;
        }

        // Ejecutamos esta función cuando la página se carga
        setSelectedFilters();

        // Evento para aplicar el filtro cuando cambian los checkboxes
        categoryCheckboxes.forEach(cb => cb.addEventListener('change', applyFilters));
        brandCheckboxes.forEach(cb => cb.addEventListener('change', applyFilters));
        sizeCheckboxes.forEach(cb => cb.addEventListener('change', applyFilters));
        [minPriceInput, maxPriceInput, priceRangeInput].forEach(input => input.addEventListener('change', function() {
            document.getElementById('priceValue').textContent = `$${priceRangeInput.value}`;
        }));
    
        // Aplicar filtro manual cuando se hace clic en el botón "Filtrar por Precio"
        applyPriceFilterButton.addEventListener('click', applyFilters);
    });
</script>

