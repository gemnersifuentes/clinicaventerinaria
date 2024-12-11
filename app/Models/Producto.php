<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Tabla en la base de datos

    protected $fillable = [
        'nombre',
        'Codigo',
        'descripcion',
        'precio',
        'stock',
        'imagenes',
        'condicion',
        'descuento',
        'estado',
        'categoria_id',
        'marca_id',
    ];

    protected $casts = [
        'imagenes' => 'array', // Si 'imagenes' es un campo JSON
    ];

    // Relación con Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // Relación con Marca
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

 
   

   // En el modelo Producto
public function tallas()
{
    return $this->belongsToMany(Categoria::class, 'producto_talla')
                ->withPivot('precio', 'stock'); // Especificar las columnas adicionales
}

}
