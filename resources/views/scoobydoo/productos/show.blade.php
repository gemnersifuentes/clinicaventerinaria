
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="bg-gray-50">
    
@extends('scoobydoo.layouts.main')

@section('content')
<div class="container mx-auto px-4 py-12     bg-white rounded-lg shadow-lg mt-10">
    <div class="flex flex-col   lg:flex-row gap-12">
        <!-- Galería de imágenes -->
        <div class="lg:w-[60%] flex gap-6  p-6 rounded-lg">
            <!-- Imágenes pequeñas a la izquierda -->
            <div class="lg:w-1/6 flex flex-col gap-4">
                <div class="grid grid-cols-1 gap-4 ">
                    @forelse($imagenes as $index => $imagen)
                        <img 
                            src="{{ asset('storage/' . $imagen) }}" 
                            alt="Imagen de {{ $producto->nombre }}" 
                            class=" object-cover rounded-lg shadow cursor-pointer transition-transform transform hover:scale-110 hover:opacity-80" 
                            onclick="cambiarImagenPrincipal(this.src); seleccionarImagen(this)"
                            id="imagen{{ $index }}"
                        >
                    @empty
                        <p class="text-center text-gray-500 italic">No hay imágenes disponibles.</p>
                    @endforelse
                </div>
            </div>
            
        
            <!-- Imagen grande a la derecha -->
            <div class="lg:w-3/4 relative h-[500px]">
                <div class="mb-4 overflow-hidden rounded-xl shadow-lg">
                    <div class="relative">
                        <img 
                            id="imagenPrincipal" 
                            src="{{ asset('storage/' . ($imagenes[0] ?? 'placeholder.jpg')) }}" 
                            alt="Imagen principal de {{ $producto->nombre }}" 
                            class="w-full h-[400px] object-cover cursor-pointer"
                        >
                    </div>
                </div>
            </div>
        </div>
       
        <script>
            // Función para cambiar la imagen principal
            function cambiarImagenPrincipal(src) {
                document.getElementById('imagenPrincipal').src = src;
            }
        
            // Función para seleccionar la imagen y darle estilo
            function seleccionarImagen(imagen) {
                // Elimina la clase 'border-2' de todas las imágenes
                let imagenes = document.querySelectorAll('.lg\\:w-1\\/4 img');
                imagenes.forEach(img => img.classList.remove('border-2', 'border-blue-500'));
        
                // Agrega un borde azul a la imagen seleccionada
                imagen.classList.add('border-2', 'border-blue-500');
            }
        </script>
        
  
    
        <script>
            const imagenPrincipal = document.getElementById('imagenPrincipal');
        
            // Detectar movimiento del mouse
            imagenPrincipal.addEventListener('mousemove', (event) => {
                const rect = imagenPrincipal.getBoundingClientRect();
        
                // Calcular las coordenadas del mouse en porcentaje respecto a la imagen
                const x = ((event.clientX - rect.left) / rect.width) * 100;
                const y = ((event.clientY - rect.top) / rect.height) * 100;
        
                // Aplicar el zoom directamente sobre la imagen
                imagenPrincipal.style.transformOrigin = `${x}% ${y}%`;
                imagenPrincipal.style.transform = 'scale(2.5)'; // Mayor zoom
            });
        
            // Quitar zoom cuando el mouse salga de la imagen
            imagenPrincipal.addEventListener('mouseleave', () => {
                imagenPrincipal.style.transform = 'scale(1)';
            });
        </script>
    
<style>


    </style>        

        <!-- Información del producto -->
        <div class="lg:w-[40%]  ">
           
            
           
              
            <div class="ml-4">
                <h1 class="text-2xl font-bold  text-gray-800">{{ $producto->nombre }}</h1>
            </div>
            <div class="flex flex-col" >
                <div class="bg-white px-4 py-3  rounded-xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 transition-shadow duration-300">
                    
                    <div class="flex flex-col space-y-2">
                     
                        <div class="flex items-center space-x-2">
                            
                            <!-- Mostrar el precio con descuento y el porcentaje de descuento al lado -->
                            <p id="precio" class="text-2xl font-semibold text-indigo-600">
                                @if($producto->descuento > 0)
                                    <!-- Si hay descuento, mostrar precio con descuento -->
                                    S/. <span id="precioConDescuento" class="font-bold text-lg">
                                        {{ number_format($producto->precio - ($producto->precio * ($producto->descuento / 100)), 2) }}
                                    </span>
                                    
                                    <p class="text-indigo-600 text-sm font-semibold  rounded-full ml-2"> decuento:
                                        @if (floor($producto->descuento) == $producto->descuento)
                                            {{ floor($producto->descuento) }}%
                                        @else
                                            {{ number_format($producto->descuento, 2) }}%
                                        @endif
                                    </p>
                                    
                                @else
                                    <!-- Si no hay descuento, solo mostrar precio normal -->
                                    S/. <span id="precioSinDescuento" class="text-lg font-medium">{{ number_format($producto->precio, 2) }}</span>
                                @endif
                            </p>
                        </div>
                    
                        @if($producto->descuento > 0)
                        <div class="flex items-center space-x-4">
                            <p class="text-gray-500 line-through text-sm" id="precioOriginal">
                                S/. {{ number_format($producto->precio, 2) }}
                            </p>
                            <p id="stockDisponible" class="text-white  text-sm font-semibold  px-2 rounded-full opacity-75" style="font-size: 10px">En stock</p>
                            @if(!$esRopa)
                            @if($producto->stock > 5)
                                <p id="stockGeneral" class="text-white bg-green-400 text-sm font-semibold  px-2 rounded-full opacity-75" style="font-size: 10px">En stock</p>
                            @elseif($producto->stock > 0)
                                <p id="stockGeneral" class="text-white bg-orange-500 px-2 rounded-full text-sm font-medium opacity-75" style="font-size: 10px">Casi agotado</p>
                            @else
                                <p id="stockGeneral" class="text-white bg-red-500  font-semibold  px-2 rounded-full  " style="font-size: 10px" >Agotado</p>
                            @endif
                        @endif
                        </div>
                    @endif
                    
                   
                    </div>
            
                    <div class="flex flex-col space-y-4 ">
                          @if($esRopa)
                    <div class="mb-2">
                        <h3 class="text-sm font-semibold mb-2">Tallas Disponibles</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($tallasConPrecioYStock as $talla)
                                <label class="size-checkbox">
                                    <input type="radio" name="talla" class="hidden peer" value="{{ $talla['id'] }}" data-price="{{ $talla['precio'] }}" data-stock="{{ $talla['stock'] }}" onchange="actualizarPrecio(this)">
                                    <span class="inline-flex items-center justify-center w-10 h-10 text-gray-700 peer-checked:text-white bg-white peer-checked:bg-indigo-600 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-100 transition-colors">
                                        {{ $talla['nombre'] }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg bg-opacity-75 mb-5">
                <div class=" px-4 py-1 mb-0 rounded-xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                    <!-- Primer div - Ordenar por -->
                    <div class=" text-gray-600 text-sm flex flex-col">
                   
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-600 text-right" style="font-size:11px;">Código: <span>{{ $producto->Codigo }}</span></p>
                    </div>
                </div>
              
                

                <div class="mb-4 px-4 py-1 ">
                    <h3 class="text-sm  mb-2">Descripción</h3>
                    <p class="text-gray-700 text-sm ">{{ $producto->descripcion }}</p>
                   
                </div>
                <div class=" px-4 py-1 mb-0 rounded-xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                    <!-- Primer div - Ordenar por -->
                    <div class="flex flex-col">
                  
                        <p class="text-sm  ">Marca: <span class="text-gray-600">{{ $producto->marca->marca }}</span></p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm  ">Categoría: <span class="text-gray-600">{{ $producto->categoria->nombre }}</span></p>
                       
                    </div>
                </div>
                
            </div>
            
         
        
          
    

        


        <div class="flex space-x-4">
            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden w-34 ml-4">
                <button onclick="decrement()" class="w-12 h-10 text-gray-500 hover:bg-gray-100 focus:outline-none  " style="border-right: 1px solid #e5e7eb;">
                    &minus;
                </button>
                <input
                    id="counter"
                    type="text"
                    value="1"
                    readonly
                    class="w-12 h-8 text-center text-gray-700 focus:outline-none bg-white border-none"
                />
                <button onclick="increment()" class="w-12 h-10 text-gray-500 hover:bg-gray-100 focus:outline-none" style="border-left: 1px solid #e5e7eb;">
                    &#43;
                </button>
            </div>
            
            <button class="flex-1 bg-indigo-600 text-white px-3 py-2 rounded-lg hover:bg-indigo-700 transition-colors flex items-center justify-center">
               
                Agregar al carrito
            </button>
          
        </div>



        <div class="mt-4 bg-green-100 text-green-800 font-bold px-4 py-2 rounded">
            ¡enbios al todo chachapoyas!
        </div>
           
        </div>
    </div>
</div>

<script>
    // Add this function to automatically select the first size for clothing products
    document.addEventListener('DOMContentLoaded', function() {
        @if($esRopa && count($tallasConPrecioYStock) > 0)
            // Select the first size radio button
            const firstSizeRadio = document.querySelector('input[name="talla"]');
            if (firstSizeRadio) {
                firstSizeRadio.checked = true;
                
                // Trigger the price update for the first size
                actualizarPrecio(firstSizeRadio);
            }
        @endif
    });

    function actualizarPrecio(radio) {
        // Obtener el precio de la talla seleccionada
        let precioTalla = parseFloat(radio.getAttribute('data-price'));
        let stock = parseInt(radio.getAttribute('data-stock'));

        // Calcular el descuento global (si existe) sobre el precio de la talla
        let precioConDescuento = precioTalla;
        // Comprobar si el producto tiene descuento global
        let descuento = {!! $producto->descuento !!};
        if (descuento > 0) {
            precioConDescuento = precioTalla - (precioTalla * (descuento / 100));
        }

        // Mostrar el precio con descuento si existe, de lo contrario mostrar el precio de la talla
        document.getElementById('precio').style.display = 'block';
        document.getElementById('precio').innerHTML = 'S/. ' + precioConDescuento.toFixed(2);

        // Solo mostrar el precio original si el producto es de tipo "ropa" y hay descuento
        const precioOriginal = document.getElementById('precioOriginal');
        if ('{!! $producto->categoria->nombre !!}' === 'Ropa') {
            if (descuento > 0) {
                precioOriginal.innerText = 'S/. ' + precioTalla.toFixed(2);
                precioOriginal.style.display = 'block'; // Mostrar el precio original tachado
            } else {
                precioOriginal.style.display = 'none'; // No mostrar precio original si no hay descuento
            }
        } else {
            // Si no es ropa, no mostrar precio original
            precioOriginal.style.display = 'none';
        }

        // Mostrar el stock disponible de la talla seleccionada
        document.getElementById('stockDisponible').innerText = 'Stock disponible: ' + stock;

        // Lógica para mostrar el estado del stock y desactivar el botón si es necesario
        const stockMessage = document.getElementById('stockDisponible');
        const addToCartButton = document.querySelector('.add-to-cart-button'); // Botón "Agregar al carrito"
if (stock === 0) {
    stockMessage.innerText = 'Agotado';
    stockMessage.classList.remove('bg-yellow-500', 'bg-green-500'); // Eliminar clases anteriores
    stockMessage.classList.add('bg-red-500'); // Añadir fondo rojo para "Agotado"
    addToCartButton.disabled = true; // Desactivar el botón si el stock es 0
} else if (stock <= 5) {
    stockMessage.innerText = 'Casi agotado';
    stockMessage.classList.remove('bg-red-500', 'bg-green-500'); // Eliminar clases anteriores
    stockMessage.classList.add('bg-yellow-500'); // Añadir fondo amarillo para "Casi agotado"
    addToCartButton.disabled = false; // Asegurar que el botón está habilitado si hay stock
} else {
    stockMessage.innerText = 'En stock';
    stockMessage.classList.remove('bg-red-500', 'bg-yellow-500'); // Eliminar clases anteriores
    stockMessage.classList.add('bg-green-500'); // Añadir fondo verde para "En stock"
    addToCartButton.disabled = false; // Asegurar que el botón está habilitado si hay stock
}

    }
</script>

<script>
    function cambiarImagenPrincipal(src) {
    const imagenPrincipal = document.getElementById('imagenPrincipal');

    // Reducir la opacidad para empezar la transición
    imagenPrincipal.style.opacity = '0';

    // Esperar un momento antes de cambiar la imagen
    setTimeout(() => {
        imagenPrincipal.src = src; // Cambiar la imagen principal
        imagenPrincipal.onload = () => {
            imagenPrincipal.style.opacity = '1'; // Volver a la opacidad completa después de cargar la imagen
        };
    }, 300); // Tiempo que coincide con la duración de la transición
}

</script>
@endsection

</body>
</html>
