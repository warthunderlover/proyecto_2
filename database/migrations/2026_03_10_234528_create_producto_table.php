<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // quitar el campo antes de hacer la migración de marcas 
    
    public function up(): void
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre_producto',100);
            $table->string('imagen')->nullable();
            $table->boolean('estado_producto')->default(true);
            $table->decimal('precio_compra', 10, 2);
            $table->integer('cantidad_stock');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::dropIfExists('producto');
    }
};
