<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarritoItem extends Model
{
    protected $table = 'carrito_items';

    protected $fillable = [
        'cliente_id', 
        'producto_id', 
        'categoria_id', 
        'cantidad', 
        'precio', 
        'detalles'
    ];

    protected $casts = [
        'detalles' => 'array'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
