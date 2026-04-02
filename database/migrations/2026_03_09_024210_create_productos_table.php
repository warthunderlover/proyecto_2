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
            $table->string('nombre');
            $table->string('imagen')->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('stock')->default(0); // stock inicia en 0
            $table->decimal('precio', 10, 2);
            $table->enum('estado', ['activo', 'inactivo'])->default('activo'); // estado predeterminado
            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};