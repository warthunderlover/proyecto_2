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
        Schema::create('table_reviews', function (Blueprint $table) {
            $table->id('id_review');
            $table->unsignedBigInteger('id_producto');
            $table->tinyInteger('calificacion')->unsigned();
            $table->text('comentario')->nullable();
            $table->timestamps();

            $table->foreign('id_producto')->references('id_producto')->on('producto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_reviews');
    }
};
