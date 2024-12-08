<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('producto_talla', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->decimal('precio', 8, 2)->nullable();
            $table->integer('stock')->nullable();
            $table->timestamps();
        });
        
    }
    
    public function down()
    {
        Schema::dropIfExists('producto_talla');
    }
    
};
