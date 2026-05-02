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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('id_pedido');
            $table->unsignedBigInteger('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_direccion')->references('id_direccion')->on('direccions')->onDelete('cascade');
            $table->string('folio');
            $table->string('metodoPago');
            $table->decimal('totalCompra', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
