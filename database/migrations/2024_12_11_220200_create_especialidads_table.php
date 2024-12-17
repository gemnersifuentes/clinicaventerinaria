<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('especialidads', function (Blueprint $table) {
            // Clave primaria de la tabla
            $table->id();

            // Campos para almacenar los detalles de la especialidad
            $table->string('nombre', 255);  // Nombre de la especialidad
            $table->text('descripcion')->nullable();  // Descripción de la especialidad
            $table->string('codigo')->nullable()->unique();  // Código único para la especialidad (opcional)
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');  // Estado de la especialidad

            // Campos para fechas de creación y actualización automáticas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('especialidads');
    }
};



