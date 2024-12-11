<?php

namespace App\Http\Controllers\Tienda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Talla;

class CartController extends Controller
{
    // Método para agregar un producto al carrito
    public function addToCart(Request $request, $productoId)
    {
        // Validate request
        $request->validate([
            'talla_id' => 'nullable|exists:tallas,id'
        ]);
    
        try {
            // Get the product
            $producto = Producto::findOrFail($productoId);
    
            // Initialize cart
            $cart = session()->get('cart', []);
    
            // Check if product is clothing and requires size
            if ($producto->categoria->nombre == 'Ropa') {
                $tallaId = $request->input('talla_id');
                
                // Validate talla for clothing
                $talla = $producto->tallas()->where('tallas.id', $tallaId)->first();
                
                if (!$talla) {
                    return response()->json([
                        'success' => false, 
                        'message' => 'Talla no válida.'
                    ], 400);
                }
    
                // Check stock
                $pivotData = $producto->tallas()->where('tallas.id', $tallaId)->first()->pivot;
                if ($pivotData->stock <= 0) {
                    return response()->json([
                        'success' => false, 
                        'message' => 'Producto agotado.'
                    ], 400);
                }
    
                // Create or update cart item
                $cartKey = "{$productoId}_{$tallaId}";
                if (isset($cart[$cartKey])) {
                    $cart[$cartKey]['cantidad']++;
                } else {
                    $cart[$cartKey] = [
                        'producto_id' => $productoId,
                        'nombre' => $producto->nombre,
                        'talla_id' => $tallaId,
                        'talla_nombre' => $talla->nombre,
                        'precio' => $pivotData->precio,
                        'cantidad' => 1,
                        'imagen' => json_decode($producto->imagenes)[0] ?? null
                    ];
                }
            } else {
                // Non-clothing product
                if (isset($cart[$productoId])) {
                    $cart[$productoId]['cantidad']++;
                } else {
                    $cart[$productoId] = [
                        'producto_id' => $productoId,
                        'nombre' => $producto->nombre,
                        'precio' => $producto->precio,
                        'cantidad' => 1,
                        'imagen' => json_decode($producto->imagenes)[0] ?? null
                    ];
                }
            }
    
            // Save cart to session
            session()->put('cart', $cart);
    
            // Return success response
            return response()->json([
                'success' => true, 
                'message' => 'Producto agregado al carrito',
                'cartCount' => count($cart)
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Error al agregar producto: ' . $e->getMessage()
            ], 500);
        }
    }

    // Método para mostrar el carrito
    public function showCart()
    {
        // Obtener los productos del carrito
        $cart = session()->get('cart', []);
        return view('scoobydoo.cart.index', compact('cart'));
    }

    // Método para eliminar un producto del carrito
    public function removeFromCart($productoId)
    {
        $cart = session()->get('cart', []);

        // Eliminar el producto seleccionado
        if (isset($cart[$productoId])) {
            unset($cart[$productoId]);
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('cart', $cart);

        return redirect()->route('cart.show');
    }

    // Método para actualizar la cantidad de un producto en el carrito
    public function updateCart(Request $request, $productoId)
    {
        $cart = session()->get('cart', []);

        // Verificar si el producto existe en el carrito
        if (isset($cart[$productoId])) {
            // Actualizar la cantidad del producto
            $cart[$productoId]['cantidad'] = $request->input('cantidad');
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('cart', $cart);

        return redirect()->route('cart.show');
    }
}
