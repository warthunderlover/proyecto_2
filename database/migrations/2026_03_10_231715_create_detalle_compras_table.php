<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * correr esta migración
     */
    public function up(): void
    {
        Schema::create('detalle_compras', function (Blueprint $table) {
            $table  ->id('id_detalle_compra');
            $table  ->unsignedBigInteger('id_compra');
            $table  ->unsignedBigInteger('id_producto');
            $table  ->integer('cantidad');
            $table  ->decimal('precio_unitario', 10, 2);
            $table  ->decimal('subtotal', 10, 2);
            $table  ->timestamps();

            $table  ->foreign('id_producto')
                    ->references('id_producto')
                    ->on('producto')
                    ->onDelete('cascade');
            
            $table  ->foreign('id_compra')
                    ->references('id_compra')
                    ->on('compras')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_compras');
    }
};
