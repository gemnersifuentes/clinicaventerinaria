<?php

namespace App\Http\Controllers\Tienda;

use App\Models\CarritoItem;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductoVariacion;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Talla;

class CartController extends Controller
{
    // Método para agregar un producto al carrito
    public function addToCart(Request $request, $producto_id)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::guard('cliente')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Debes iniciar sesión para agregar productos al carrito'
            ], 401);
        }

        // Buscar el producto
        $producto = Producto::findOrFail($producto_id);

        // Verificar si es un producto de ropa
        $esRopa = $producto->categoria->nombre === 'Ropa';

        // Si es ropa, requiere talla
        if ($esRopa) {
            $request->validate([
                'talla_id' => 'required|exists:categorias,id'
            ]);

            // Buscar la relación de talla específica
            $tallaPivot = DB::table('producto_talla')
                ->where('producto_id', $producto_id)
                ->where('categoria_id', $request->talla_id)
                ->first();

            // Verificar stock de la talla
            if (!$tallaPivot || $tallaPivot->stock <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Talla seleccionada sin stock'
                ], 400);
            }

            // Crear o actualizar item del carrito con talla
            $cliente = Auth::guard('cliente')->user();
            $carritoItem = CarritoItem::firstOrNew([
                'cliente_id' => $cliente->id,
                'producto_id' => $producto_id,
                'categoria_id' => $request->talla_id  // Usar ID de talla como categoría
            ]);

            $carritoItem->cantidad += 1;
            $carritoItem->precio = $tallaPivot->precio;
            $carritoItem->detalles = json_encode([
                'talla_id' => $request->talla_id,
                'talla_nombre' => Categoria::find($request->talla_id)->nombre
            ]);
            $carritoItem->save();

            // Reducir stock de la talla
            DB::table('producto_talla')
                ->where('producto_id', $producto_id)
                ->where('categoria_id', $request->talla_id)
                ->decrement('stock');
        } 
        // Productos sin tallas
        else {
            // Verificar stock del producto
            if ($producto->stock <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Producto sin stock'
                ], 400);
            }

            $cliente = Auth::guard('cliente')->user();
            $carritoItem = CarritoItem::firstOrNew([
                'cliente_id' => $cliente->id,
                'producto_id' => $producto_id,
                'categoria_id' => $producto->categoria_id
            ]);

            $carritoItem->cantidad += 1;
            $carritoItem->precio = $producto->precio;
            $carritoItem->save();

            // Reducir stock del producto
            $producto->stock -= 1;
            $producto->save();
        }

        // Contar items en el carrito
        $cartCount = CarritoItem::where('cliente_id', $cliente->id)->count();

        return response()->json([
            'success' => true,
            'message' => 'Producto agregado al carrito',
            'cartCount' => $cartCount
        ]);
    }
}
