<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Marca extends Model
{
    
    use HasFactory;

    protected $table = 'marcas'; // Tabla en la base de datos


    // Relación con los productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'marca_id');
    }
}
