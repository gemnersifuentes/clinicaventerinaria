<!-- cart/index.blade.php -->
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Mi carrito de compras</h1>

    @if(count($cart) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left">Producto</th>
                        <th class="px-4 py-2 text-left">Talla</th>
                        <th class="px-4 py-2 text-left">Cantidad</th>
                        <th class="px-4 py-2 text-left">Precio</th>
                        <th class="px-4 py-2 text-left">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $productoId => $producto)
                        <tr>
                            <td class="px-4 py-2">
                                <img src="{{ asset('storage/' . $producto['imagen']) }}" alt="{{ $producto['nombre'] }}" class="w-16 h-16 object-cover inline-block mr-2">
                                {{ $producto['nombre'] }}
                            </td>
                            <td class="px-4 py-2">{{ $producto['talla'] ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $producto['cantidad'] }}</td>
                            <td class="px-4 py-2">
                                @if(isset($producto['descuento']))
                                    <span class="line-through text-gray-500">{{ $producto['precio'] }} </span>
                                    {{ round($producto['precio'] - ($producto['precio'] * ($producto['descuento'] / 100)), 2) }}
                                @else
                                    {{ $producto['precio'] }}
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if(isset($producto['descuento']))
                                    {{ round($producto['cantidad'] * ($producto['precio'] - ($producto['precio'] * ($producto['descuento'] / 100))), 2) }}
                                @else
                                    {{ $producto['cantidad'] * $producto['precio'] }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex justify-between">
            <span class="font-semibold text-lg">Total:</span>
            <span class="font-semibold text-lg">
                {{ array_sum(array_map(function($producto) {
                    return isset($producto['descuento']) ?
                        round($producto['cantidad'] * ($producto['precio'] - ($producto['precio'] * ($producto['descuento'] / 100))), 2) :
                        $producto['cantidad'] * $producto['precio'];
                }, $cart)) }}
            </span>
        </div>

        <div class="mt-4 flex justify-between">
            <a href="{{ route('checkout') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition-colors">Ir a la compra</a>
        </div>

    @else
        <p>No hay productos en tu carrito.</p>
    @endif
</div>
