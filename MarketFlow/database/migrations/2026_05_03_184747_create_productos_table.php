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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->unsignedBigInteger('id_categoria')->references('id_categoria')->on('categorias')->onDelete('cascade');
            $table->unsignedBigInteger('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('nombre');
            $table->text('descripcion');
            $table->integer('stock');
            $table->decimal('precio', 8, 2);
            $table->boolean('activo')->default(true);
            $table->timestamps();
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
