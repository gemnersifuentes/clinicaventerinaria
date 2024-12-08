<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre de la categoría
            $table->string('descripcion')->nullable(); // Descripción de la categoría
            $table->unsignedBigInteger('parent_id')->nullable(); // Relación recursiva (categoría padre)
            $table->timestamps();
            // Clave foránea para la relación recursiva
            $table->foreign('parent_id')->references('id')->on('categorias')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
