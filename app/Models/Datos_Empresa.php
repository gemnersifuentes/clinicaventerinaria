<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datos_Empresa extends Model
{
    use HasFactory;

    /**
     * Campos permitidos para la asignación masiva.
     */
    protected $fillable = [
        'nombre_empresa',
        'direccion',
        'telefono',
        'email',
        'ruc_empresa',
        'logo_empresa',
        'mision_empresa',
        'vision_empresa',
    ];
}
