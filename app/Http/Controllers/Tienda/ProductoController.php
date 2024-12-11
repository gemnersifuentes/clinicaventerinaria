<?php

namespace App\Http\Controllers\Tienda;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        // Obtener opciones de filtro
        $sortBy = $request->input('sort', 'todos');
        $selectedCategories = $request->input('categories', []); // Categorías seleccionadas
        $selectedBrands = $request->input('brands', []); // Marcas seleccionadas
        $selectedTallas = $request->input('tallas', []); // Tallas seleccionadas
        $minPrice = $request->input('minPrice', 0); // Precio mínimo
        $maxPrice = $request->input('maxPrice', 10000); // Precio máximo
    
        // Base query
        $query = Producto::with(['categoria', 'tallas', 'marca'])->where('productos.estado', 'activo');
    
        // Filtros por categorías
        if (!empty($selectedCategories)) {
            $query->whereHas('categoria', function ($q) use ($selectedCategories) {
                $q->whereIn('categorias.id', $selectedCategories);
            });
        }
    
        // Filtros por marcas
        if (!empty($selectedBrands)) {
            $query->whereIn('productos.marca_id', $selectedBrands);
        }
    
        // Filtros por tallas
        if (!empty($selectedTallas)) {
            $query->whereHas('tallas', function ($q) use ($selectedTallas) {
                $q->whereIn('categorias.id', $selectedTallas);
            });
        }
    
        // Filtros por rango de precio
        if ($minPrice > 0 || $maxPrice < 10000) {
            $query->whereBetween('productos.precio', [$minPrice, $maxPrice]);
        }
    
        // Ordenamiento
        switch ($sortBy) {
            case 'todos':
                $query->orderBy('productos.created_at');
                break;
            case 'brand':
                $query->orderBy('productos.marca_id');
                break;
            case 'price-low-high':
                $query->orderBy('productos.precio');
                break;
            case 'price-high-low':
                $query->orderByDesc('productos.precio');
                break;
            case 'rating':
                $query->orderByDesc('productos.rating');
                break;
            default:
                $query->where('productos.condicion', 'nuevo');
        }
    
        // Obtener productos
        $productos = $query->paginate(16);
    
        // Obtener precios mínimos y máximos para cada producto que sea "Ropa"
        foreach ($productos as $producto) {
            $minPrice = 0;
            $maxPrice = 0;
    
            // Verificar si es ropa
            if ($producto->categoria->nombre == 'Ropa') {
                $tallas = $producto->tallas; // Obtiene las tallas asociadas
    
                // Verificar si el producto tiene tallas y si hay más de una
                if ($tallas->isNotEmpty()) {
                    // Si solo hay una talla, no mostrar rango
                    if ($tallas->count() == 1) {
                        $minPrice = $tallas->first()->pivot->precio;
                        $maxPrice = $minPrice; // Solo un precio, así que min y max son iguales
                    } else {
                        // Si hay más de una talla, calcular el precio mínimo y máximo
                        $minPrice = $tallas->min('pivot.precio');
                        $maxPrice = $tallas->max('pivot.precio');
                    }
                }
            }
    
            // Asignar los precios mínimos y máximos al producto
            $producto->min_price = $minPrice;
            $producto->max_price = $maxPrice;
        }
        // Datos adicionales para los filtros
        $categorias = Categoria::whereNull('parent_id')->with('children')->get();
        $marcas = Marca::all();
        $tallaCategory = Categoria::where('nombre', 'Talla')->first();
        $tallas = $tallaCategory ? Categoria::where('parent_id', $tallaCategory->id)->get() : collect();
    
        return view('scoobydoo.productos.index', compact(
            'productos', 'categorias', 'tallas', 'marcas', 'sortBy', 'selectedCategories', 'selectedBrands', 'selectedTallas', 'minPrice', 'maxPrice'
        ));
    }
    

    public function show($id)
    {
        // Obtener el producto por ID con sus relaciones
        $producto = Producto::with(['categoria', 'tallas', 'marca'])->findOrFail($id);
    
        // Verificar si el producto es de la categoría "Ropa"
        $esRopa = $producto->categoria->nombre == 'Ropa';  // Cambia 'Ropa' por el nombre exacto de la categoría de ropa en tu base de datos
        $imagenes = $producto->imagenes ? json_decode($producto->imagenes, true) : [];
    
        // Precios, descuentos y stock de las tallas
        $tallasConPrecioYStock = [];
        if ($esRopa) {
            foreach ($producto->tallas as $talla) {
                $tallasConPrecioYStock[] = [
                    'id' => $talla->id,
                    'nombre' => $talla->nombre,
                    'precio' => $talla->pivot->precio,
                    'stock' => $talla->pivot->stock,
                ];
            }
        }
    
        // Pasar la información al front-end
        return view('scoobydoo.productos.show', compact('producto', 'imagenes', 'esRopa', 'tallasConPrecioYStock'));
    }


  
    public function search(Request $request)
    {
        $queryText = $request->input('search'); // Captura el texto ingresado

        // Valida que el parámetro no esté vacío
        if (empty($queryText)) {
            return redirect()->route('scoobydoo.productos.index')->with('error', 'Ingrese un término de búsqueda.');
        }

        // Realiza la búsqueda
        $productos = Producto::with(['categoria', 'marca'])
            ->where('estado', 'activo')
            ->where(function ($query) use ($queryText) {
                $query->where('nombre', 'LIKE', "%$queryText%")
                      ->orWhere('descripcion', 'LIKE', "%$queryText%");
            })
            ->paginate(16);

        // Retorna la vista con los resultados
        return view('scoobydoo.productos.index', compact('productos', 'queryText'));
    }
    
}