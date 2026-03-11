<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * no correr estas migraciones
     */
    public function up(): void
    {
        /*
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id('id_proveedor');
            $table->string('nombre_proveedor', 100);
            $table->string('direccion_proveedor', 200);
            $table->string('telefono_proveedor', 20);
            $table->boolean('estado_proveedor')->default(true);
            $table->timestamps();
        });
/*
        Schema::create('marcas', function (Blueprint $table){
            $table->id('id_marca');
            $table->string('nombre_marca',50);
            $table->unsignedBigInteger('id_proveedor');
            $table->boolean('estado_marca')->default(true);
            $table->timestamps();   

            $table->foreign('id_proveedor')
                  ->references('id_proveedor')
                  ->on('proveedores')
                  ->onDelete('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
