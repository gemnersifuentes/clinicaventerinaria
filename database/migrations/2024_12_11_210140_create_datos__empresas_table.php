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
        Schema::create('datos__empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->string('ruc_empresa');
            $table->string('logo_empresa');
            $table->string('mision_empresa');
            $table->string('vision_empresa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos__empresas');
    }
};
