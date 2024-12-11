
<script>

    // Función para abrir el modal
    function openModal(producto) {
        if (producto.categoria.nombre === 'Ropa') {
            let imagenes = JSON.parse(producto.imagenes);
            let imagenPrincipal = imagenes[0] ?? 'default-image.jpg';
    
            let tallasHTML = '';
            producto.tallas.forEach(talla => {
                tallasHTML += `
                    <button 
                        data-precio="${talla.pivot.precio}" 
                        data-descuento="${producto.descuento || 0}" 
                        data-id="${talla.id}"
                        data-stock="${talla.pivot.stock}"
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-indigo-600 hover:text-white transition"
                        onclick="selectTalla(this)">
                        ${talla.nombre}
                    </button>`;
            });
    
            document.getElementById('tallasContainer').innerHTML = tallasHTML;
            document.getElementById('modalTitle').innerText = producto.nombre;
    
            // Usar la ruta de la imagen
            document.getElementById('modalImage').src = `/storage/${imagenPrincipal}`;
    
            // Inicializar valores en el modal
            document.getElementById('modalPrice').innerHTML = '';
            document.getElementById('modalStock').innerText = '';
            document.getElementById('modal').classList.remove('hidden');
    
            // Seleccionar automáticamente la primera talla si existe
            const primeraTalla = document.querySelector('#tallasContainer button');
            if (primeraTalla) {
                primeraTalla.click();
            }
        }
    }
    // Función para seleccionar una talla
    function selectTalla(button) {
        // Desmarcar todos los botones
        const botones = document.querySelectorAll('#tallasContainer button');
        botones.forEach(btn => {
            btn.classList.remove('bg-indigo-600', 'text-white');
            btn.classList.add('bg-gray-200', 'text-gray-800');
        });
    
        // Marcar el botón seleccionado
        button.classList.remove('bg-gray-200', 'text-gray-800');
        button.classList.add('bg-indigo-600', 'text-white');
    
        // Obtener el precio, descuento y stock de la talla seleccionada
        let precio = parseFloat(button.getAttribute('data-precio'));
        let descuento = parseFloat(button.getAttribute('data-descuento'));
        let stock = parseInt(button.getAttribute('data-stock'));
    
        // Mostrar precios en el modal
        let precioHTML = '';
        let descuentoHTML = ''; // Variable para el texto del descuento
    
        if (descuento > 0) {
            // Si hay descuento, mostrar precio con descuento y el porcentaje al lado
            let precioConDescuento = precio - (precio * descuento / 100);
            precioHTML = `
                <div class="flex items-center mt-2">
                    <span class="text-xl font-bold text-indigo-600">$${precioConDescuento.toFixed(2)}</span>
                    <span class="ml-3 text-sm text-white mx-3 my-4 rounded-full bg-red-500" style="padding: 0.25rem 0.5rem;">${descuento}%</span>
                </div>
                <div style="margin-top: -0.5rem!important;">
                    <span class="text-sm text-gray-400 line-through">$${precio.toFixed(2)}</span>
                </div>
            `;
        } else {
            // Si no hay descuento, solo mostrar el precio original
            precioHTML = `<span class="text-xl font-bold text-indigo-600">$${precio.toFixed(2)}</span>`;
        }
    
        // Actualizar el precio y el descuento en el modal
        document.getElementById('modalPrice').innerHTML = precioHTML;
    
        // Actualizar el stock en el modal
        let stockHTML = '';
        let stockClass = ''; // Clases dinámicas para el fondo
    
        if (stock === 0) {
            stockHTML = 'Agotado';
            stockClass = 'bg-red-500'; // Fondo rojo
        } else if (stock <= 5) {
            stockHTML = `Casi agotado`;
            stockClass = 'bg-yellow-500'; // Fondo amarillo
        } else {
            stockHTML = `En stock`;
            stockClass = 'bg-green-500'; // Fondo verde
        }
    
        // Cambiar el fondo dinámicamente solo en el texto de stock
        const stockElement = document.getElementById('modalStock');
        stockElement.innerText = stockHTML;
        stockElement.className = `text-white p-1 mx-5 rounded-full text-[9px] ml-[-10]  ${stockClass}`; // Aplicar la clase de fondo
    
        // Si el stock es 0, desactivar el botón de agregar al carrito
        const addToCartButton = document.getElementById('addToCartButton');
        if (stock <= 0) {
            addToCartButton.disabled = true;
            addToCartButton.classList.add('bg-gray-400', 'cursor-not-allowed');
        } else {
            addToCartButton.disabled = false;
            addToCartButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
        }
    }
    
    
    
    
        // Función para cerrar el modal
        function closeModal() {
            const modal = document.getElementById('modal');
            const modalContent = modal.querySelector('.modal-content');
    
            // Agregar clase de cierre para animación
            modalContent.classList.add('closing');
    
            // Esperar que la animación termine antes de ocultar el modal
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Duración de la animación (300ms)
        }
    </script>
    
    
        <script>
             // Toggle categorías
             document.getElementById('categoriesToggle').addEventListener('click', function() {
                const categoriesList = document.getElementById('categoriesList');
                const arrow = this.querySelector('svg');
                categoriesList.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180');
            });
            document.getElementById('categoriesToggle2').addEventListener('click', function() {
                const categoriesList = document.getElementById('categoriesList2');
                const arrow = this.querySelector('svg');
                categoriesList.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180');
            });
            // Actualizar valor del precio
            const priceRange = document.getElementById('priceRange');
            const priceValue = document.getElementById('priceValue');
            const minPrice = document.getElementById('minPrice');
            const maxPrice = document.getElementById('maxPrice');
    
            priceRange.addEventListener('input', function() {
                priceValue.textContent = '$' + this.value;
                maxPrice.value = this.value;
            });
    
            minPrice.addEventListener('input', function() {
                priceRange.min = this.value;
                if (parseInt(maxPrice.value) < parseInt(this.value)) {
                    maxPrice.value = this.value;
                }
            });
    
            maxPrice.addEventListener('input', function() {
                priceRange.max = this.value;
                if (parseInt(minPrice.value) > parseInt(this.value)) {
                    minPrice.value = this.value;
                }
            });
          
     function addToCart() {
        // Obtener el producto seleccionado
        const selectedTalla = document.querySelector('#tallasContainer button.bg-indigo-600');
        
        if (!selectedTalla) {
            alert('Por favor, selecciona una talla');
            return;
        }
    
        // Extraer información del producto
        const productId = selectedTalla.getAttribute('data-producto-id') || document.getElementById('modalTitle').dataset.productId;
        const tallaId = selectedTalla.getAttribute('data-id');
    
        // Verificar stock
        const stock = parseInt(selectedTalla.getAttribute('data-stock') || 0);
        if (stock <= 0) {
            alert('Lo sentimos, este producto está agotado');
            return;
        }
    
        // Preparar datos para enviar
        const formData = new FormData();
        formData.append('talla_id', tallaId);
    
        // Enviar solicitud AJAX para agregar al carrito
        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mostrar mensaje de éxito
                alert(data.message);
                
                // Actualizar contador del carrito si existe
                const cartCountElement = document.getElementById('cart-count');
                if (cartCountElement) {
                    cartCountElement.textContent = data.cartCount;
                }
                
                // Cerrar modal
                closeModal();
            } else {
                // Mostrar mensaje de error
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un problema al agregar el producto al carrito');
        });
    }
    
    // Modificar la función openModal para asegurar que funcione con la nueva lógica
    function openModal(producto) {
        if (producto.categoria.nombre === 'Ropa') {
            let imagenes = JSON.parse(producto.imagenes);
            let imagenPrincipal = imagenes[0] ?? 'default-image.jpg';
    
            let tallasHTML = '';
            producto.tallas.forEach(talla => {
                tallasHTML += `
                    <button 
                        data-producto-id="${producto.id}"
                        data-precio="${talla.pivot.precio}" 
                        data-descuento="${producto.descuento || 0}" 
                        data-id="${talla.id}"
                        data-stock="${talla.pivot.stock}"
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-indigo-600 hover:text-white transition"
                        onclick="selectTalla(this)">
                        ${talla.nombre}
                    </button>`;
            });
    
            document.getElementById('tallasContainer').innerHTML = tallasHTML;
            document.getElementById('modalTitle').innerText = producto.nombre;
            document.getElementById('modalTitle').dataset.productId = producto.id;
    
            // Usar la ruta de la imagen
            document.getElementById('modalImage').src = `/storage/${imagenPrincipal}`;
    
            // Inicializar valores en el modal
            document.getElementById('modalPrice').innerHTML = '';
            document.getElementById('modalStock').innerText = '';
            document.getElementById('modal').classList.remove('hidden');
    
            // Seleccionar automáticamente la primera talla si existe
            const primeraTalla = document.querySelector('#tallasContainer button');
            if (primeraTalla) {
                primeraTalla.click();
            }
        }
    }
           
        </script>
    
    
    
    
    
    
    