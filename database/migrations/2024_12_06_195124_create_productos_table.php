<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del producto
            $table->string('Codigo')->unique(); // Código del producto
            $table->text('descripcion')->nullable(); // Descripción detallada
            $table->json('imagenes')->nullable(); // Múltiples imágenes en formato JSON
            $table->integer('stock')->nullable(); // Stock general (si no hay variantes)
            $table->enum('condicion', ['normal', 'neevo'])->default('normal'); // Estado del producto
            $table->enum('estado', ['activo', 'inactivo'])->default('inactivo'); // Estado activo/inactivo
            $table->decimal('precio', 10, 2)->nullable(); // Precio general
            $table->decimal('descuento', 5, 2)->nullable(); // Porcentaje de descuento
            $table->unsignedBigInteger('categoria_id'); // Relación con la categoría principal
            $table->unsignedBigInteger('marca_id')->nullable(); // Relación con marca opcional
            $table->timestamps();

            // Relaciones
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
