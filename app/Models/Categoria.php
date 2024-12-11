<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias'; // Asegúrate de que coincida con el nombre de la tabla
    protected $fillable = ['nombre', 'descripcion', 'parent_id'];

    // Relación con la categoría padre
    public function parent()
    {
        return $this->belongsTo(Categoria::class, 'parent_id');
    }

    // Relación con las categorías hijas
    public function children()
    {
        return $this->hasMany(Categoria::class, 'parent_id');
    }
   

public function categoriaPadre()
{
    return $this->belongsTo(Categoria::class, 'categoria_padre_id');
}

public function subcategorias()
{
    return $this->hasMany(Categoria::class, 'categoria_padre_id');
}

public function productos()
{
    return $this->belongsToMany(Producto::class, 'producto_talla')
                ->withPivot('precio', 'stock')
                ->withTimestamps();
}


}
