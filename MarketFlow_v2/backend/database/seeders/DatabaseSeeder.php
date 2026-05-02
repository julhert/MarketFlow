<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Carrito;
use App\Models\Categorias;
use App\Models\Comentarios;
use App\Models\DetallePedido;
use App\Models\Direccion;
use App\Models\Imagenes;
use App\Models\Pedidos;
use App\Models\Productos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // 1. Usuario base para pruebas
    $user = \App\Models\User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    // 2. Direcciones (necesarias para pedidos)
    \App\Models\Direccion::factory(5)->create([
        'id_user' => $user->id
    ]);

    // 3. Categorias y Productos
    \App\Models\Categorias::factory(5)->create()->each(function ($categoria) {
        \App\Models\Productos::factory(10)->create([
            'id_categoria' => $categoria->id_categoria,
            'id_user' => \App\Models\User::first()->id, // Aseguramos que use el usuario de arriba
        ]);
    });

    // 4. Datos adicionales (Opcional, para que el front no se vea vacío)
    \App\Models\Comentarios::factory(20)->create();
    \App\Models\Carrito::factory(5)->create(['id_user' => $user->id]);
    \App\Models\Imagenes::factory(20)->create();
    \App\Models\Pedidos::factory(10)->create(['id_user' => $user->id]);
    \App\Models\DetallePedido::factory(20)->create();
    }
}
