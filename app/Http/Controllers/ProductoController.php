<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;



class ProductoController extends Controller
{
    public function index()
    {
        // Obtener todos los productos
        $productos = Producto::all();

        // Pasar los productos a la vista
        return view('admin.productos.index', compact('productos'));
    }
    public function create()
    {
        // Obtener todas las categorías y marcas para mostrarlas en el formulario
        $categorias = Categoria::all();
        $marcas = Marca::all();

        // Retornar la vista de creación pasando las categorías y marcas
        return view('admin.productos.create', compact('categorias', 'marcas'));
    }

    // Método para almacenar un nuevo producto en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos enviados por el formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'Codigo' => 'required|string|max:255|unique:productos,Codigo',
            'descripcion' => 'nullable|string',
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'nullable|integer',
            'condicion' => 'required|in:normal,neevo',
            'estado' => 'required|in:activo,inactivo',
            'precio' => 'nullable|numeric',
            'descuento' => 'nullable|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'nullable|exists:marcas,id',
        ]);

        // Subir las imágenes (si las hay) y almacenarlas
        if ($request->has('imagenes')) {
            $imagenes = [];
            foreach ($request->file('imagenes') as $imagen) {
                $imagenes[] = $imagen->store('productos', 'public');
            }
        }

        // Crear el nuevo producto
        Producto::create([
            'nombre' => $request->nombre,
            'Codigo' => $request->Codigo,
            'descripcion' => $request->descripcion,
            'imagenes' => isset($imagenes) ? json_encode($imagenes) : null,
            'stock' => $request->stock,
            'condicion' => $request->condicion,
            'estado' => $request->estado,
            'precio' => $request->precio,
            'descuento' => $request->descuento,
            'categoria_id' => $request->categoria_id,
            'marca_id' => $request->marca_id,
        ]);

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }
    public function edit($id)
    {
        // Obtener el producto, las categorías y marcas
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $marcas = Marca::all();

        // Retornar la vista de edición pasando el producto, las categorías y marcas
        return view('admin.productos.edit', compact('producto', 'categorias', 'marcas'));
    }

    // Método para actualizar el producto en la base de datos
    public function update(Request $request, $id)
    {
        // Validación de los datos enviados por el formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'Codigo' => 'required|string|max:255|unique:productos,Codigo,' . $id,
            'descripcion' => 'nullable|string',
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'nullable|integer',
            'condicion' => 'required|in:normal,neevo',
            'estado' => 'required|in:activo,inactivo',
            'precio' => 'nullable|numeric',
            'descuento' => 'nullable|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'nullable|exists:marcas,id',
        ]);

        // Obtener el producto a actualizar
        $producto = Producto::findOrFail($id);

        // Subir nuevas imágenes si las hay
        if ($request->has('imagenes')) {
            $imagenes = [];
            foreach ($request->file('imagenes') as $imagen) {
                $imagenes[] = $imagen->store('productos', 'public');
            }
        }

        // Actualizar el producto
        $producto->update([
            'nombre' => $request->nombre,
            'Codigo' => $request->Codigo,
            'descripcion' => $request->descripcion,
            'imagenes' => isset($imagenes) ? json_encode($imagenes) : $producto->imagenes,
            'stock' => $request->stock,
            'condicion' => $request->condicion,
            'estado' => $request->estado,
            'precio' => $request->precio,
            'descuento' => $request->descuento,
            'categoria_id' => $request->categoria_id,
            'marca_id' => $request->marca_id,
        ]);

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }
    public function destroy($id)
{
    // Buscar el producto por su ID
    $producto = Producto::findOrFail($id);

    // Eliminar las imágenes relacionadas si existen
    if ($producto->imagenes) {
        $imagenes = json_decode($producto->imagenes, true);

        foreach ($imagenes as $imagen) {
            // Eliminar la imagen del almacenamiento (asegúrate de que las imágenes están almacenadas en el directorio adecuado)
            $path = storage_path('app/public/' . $imagen);
            if (file_exists($path)) {
                unlink($path); // Eliminar el archivo
            }
        }
    }

    // Eliminar el producto de la base de datos
    $producto->delete();

    // Redirigir a la lista de productos con un mensaje de éxito
    return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
}
// Método para mostrar tallas de un producto
public function manageTallas($productoId)
{
    $producto = Producto::findOrFail($productoId);
    
    // Obtener el ID de la categoría "Talla" (que en tu caso es "Ropa" -> "Talla")
    $tallaCategory = Categoria::where('nombre', 'Talla')->first();

    // Obtener solo las subcategorías que corresponden a "Talla" (es decir, las tallas)
    if ($tallaCategory) {
        $tallas = Categoria::where('parent_id', $tallaCategory->id)->get();  // Obtener las tallas
    } else {
        $tallas = collect();  // Si no se encuentra la categoría "Talla", devolvemos un conjunto vacío
    }

    return view('admin.productos.tallas', compact('producto', 'tallas'));
}


public function updateTallas(Request $request, $productoId)
{
    $producto = Producto::findOrFail($productoId);

    // Verifica que el campo 'tallas' esté presente en la solicitud
    if (!$request->has('tallas')) {
        return redirect()->back()->withErrors(['tallas' => 'No se han proporcionado tallas.']);
    }

    // Itera sobre los datos de las tallas
    foreach ($request->input('tallas') as $index => $tallaData) {
        // Verifica que 'id', 'precio' y 'stock' estén presentes
        if (!isset($tallaData['id']) || !isset($tallaData['precio']) || !isset($tallaData['stock'])) {
            return redirect()->back()->withErrors(['talla_id' => 'Faltan datos para la talla: ID, Precio o Stock.']);
        }

        // Verifica que el 'id' de la talla exista en la tabla de 'categorias'
        $talla = Categoria::find($tallaData['id']);
        if (!$talla) {
            return redirect()->back()->withErrors(['talla_id' => 'La talla seleccionada no es válida.']);
        }

        // Asocia la talla al producto con los datos adicionales (precio y stock)
        $producto->tallas()->attach($tallaData['id'], [
            'precio' => $tallaData['precio'],
            'stock' => $tallaData['stock'],
        ]);
    }

    // Redirige a la vista de gestión de tallas con un mensaje de éxito
    return redirect()->route('productos.manageTallas', $productoId)->with('success', 'Tallas actualizadas correctamente.');
}






}
