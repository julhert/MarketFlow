<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            // Agregamos la columna imagen, permitiendo que esté vacía (nullable)
            $table->string('imagen')->nullable()->after('id_categoria');
        });
    }

    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            // Si nos arrepentimos, la borramos
            $table->dropColumn('imagen');
        });
    }
};