<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Moda</title>
   
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes modalFadeOut {
            from { opacity: 1; transform: scale(1); }
            to { opacity: 0; transform: scale(0.8); }
        }
        .modal-content {
            animation: modalFadeIn 0.3s ease-out;
        }
        .modal-content.closing {
            animation: modalFadeOut 0.3s ease-in;
        }
        .selected {
            background-color: #6366F1; /* Indigo color */
            color: white !important;
        }
        #modal {

    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background-color: rgba(0, 0, 0, 0.5);
}
    </style>
</head>
<body class="bg-gray-50">
@extends('scoobydoo.layouts.main') <!-- Si estás utilizando un layout principal -->
@section('content')
    

    <div class="container mx-auto px-4 py-8">
      
        <div class="flex flex-wrap -mx-4">
            <!-- Filtros -->
       @include('scoobydoo.productos.layouts.filtros')

               <!-- Productos -->
<div class="w-full md:w-3/4 px-4 mb-8">
  @include('scoobydoo.productos.layouts.paginacion')	
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
        @if($productos->isEmpty())
    <p class="bg-red-600 opacity-50% p-1 px-3 w-full text-white text-[10px] ml-5">No se encontró ningún producto</p>
@else
        @foreach($productos as $producto)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 mb-4">
                <div class="relative">
                    @php
                        $imagenes = json_decode($producto->imagenes, true);
                        $imagenPrincipal = $imagenes[0] ?? 'default-image.jpg'; // Usa una imagen por defecto si no hay imágenes
                    @endphp
    
                    <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $imagenPrincipal) }}" alt="{{ $producto->nombre }}">
    
                    @if($producto->descuento > 0)
                        <span class="bg-indigo-600 absolute top-4 right-2 discount-badge text-white px-3 py-0.5 rounded-full font-semibold">
                            <span class="text-sm" style="font-size: 0.8rem!important;">
                                -{{ round($producto->descuento) }} %
                            </span>
                        </span>
                    @endif
                </div>
    
                <div class="p-6">
                    <h3 class="text-sm mb-2 text-gray-500" style="font-size: 13px!important;">{{ $producto->marca->marca ?? 'Genérico' }}</h3>
                    <a href="{{ route('productos.show', $producto->id) }}" class="font-semibold text-sm mb-2 text-gray-800" style="font-size: 15px!important;">{{ $producto->nombre }}</a>
    
                    <h6 class="text-gray-500 text- mb-4" style="font-size: 10px">por scoobydoo</h6>
    
                    <!-- Verifica si el producto es de la categoría 'ropa' -->
                    @if($producto->categoria->nombre === 'Ropa')
                        @if($producto->min_price != $producto->max_price)
                            <div class="flex justify-between items-center">
                                <p  class="text-2xl font-bold text-indigo-600" style="font-size: 1.1rem!important;"> S/. {{ $producto->min_price }} - S/. {{ $producto->max_price }}</p>
                            </div>
                        @else
                            <div class="flex justify-between items-center">
                                <p  class="text-2xl font-bold text-indigo-600" style="font-size: 1.1rem!important;"> S/. {{ $producto->min_price }}</p>
                            </div>
                        @endif
                    @else
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                @if($producto->descuento > 0)
                                    <span class="line-through text-gray-500 text-lg mr-2" style="font-size: 14px!important;">${{ $producto->precio }} </span>
                                    <span class="text-2xl font-bold text-indigo-600" style="font-size: 1.1rem!important;">
                                        ${{ $producto->precio - ($producto->precio * ($producto->descuento / 100)) }}
                                    </span>
                                @else
                                    <span class="text-2xl font-bold text-indigo-600" style="font-size: 1.1rem!important;">
                                        ${{ $producto->precio }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                    <button 
                        class="mt-3 bg-indigo-600 w-full text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition-colors" style="font-size: 13px!important;"
                        onclick="openModal({{ json_encode($producto) }})">
                        Añadir al carrito
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    @endif  
    <!-- Modal para seleccionar talla -->
    <div id="modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="modal-content bg-white rounded-xl shadow-lg p-6 max-w-2xl w-full flex flex-col md:flex-row">
            
            <!-- Imagen y detalles del producto -->
            <div class="w-full md:w-1/3 mb-4 md:mb-0 pr-4">
                <img id="modalImage" src="" alt="Imagen del producto" class="w-full h-64 object-cover rounded-lg">
            </div>
    
            <!-- Detalles principales del producto -->
            <div class="w-full md:w-2/3">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="modalTitle" class="text-2xl font-semibold text-gray-800"></h3>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-red-500">&times;</button>
                </div>
    
                <!-- Tallas disponibles y Precio -->
                <div class="mb-2">
                    <h4 class="text-lg font-medium text-gray-700">Seleccione una talla</h4>
                    <div class="flex items-center justify-between">
                        <div id="tallasContainer" class="flex flex-wrap gap-2 w-3/5">
                            <!-- Tallas cargadas dinámicamente -->
                        </div>
                        <div id="modalPrice" class="text-lg text-gray-800 w-2/5 ml-4"></div>
                    </div>
                </div>
    
                <!-- Stock disponible -->
                <div class="text-md text-gray-700 mb-4">
                    <span id="modalStock" class="text-white" style="font-size: 10px !important;">En stock</span>
                </div>
                
                <!-- Botón de agregar al carrito -->
                <div class="flex justify-end">
                    <button id="addToCartButton" class="bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition-colors">Agregar al carrito</button>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
@include('scoobydoo.productos.layouts.js')












@endsection
</body>
</html>
