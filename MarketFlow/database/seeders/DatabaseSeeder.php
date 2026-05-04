<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Carrito;
use App\Models\Categoria;
use App\Models\Comentario;
use App\Models\DetallePedido;
use App\Models\Direccion;
use App\Models\ImagenProducto;
use App\Models\Pedido;
use App\Models\Producto;
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
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 2. Direcciones (necesarias para pedidos)
        Direccion::factory(5)->create([
            'id_user' => $user->id
        ]);

        // 3. Categorias y Productos
        Categoria::factory(5)->create()->each(function ($categoria) {
            Producto::factory(10)->create([
                'id_categoria' => $categoria->id_categoria,
                'id_user' => User::first()->id, // Aseguramos que use el usuario de arriba
            ]);
        });

        // 4. Datos adicionales (Opcional, para que el front no se vea vacío)
        Comentario::factory(20)->create();
        Carrito::factory(5)->create(['id_user' => $user->id]);
        ImagenProducto::factory(20)->create();
        Pedido::factory(10)->create(['id_user' => $user->id]);
        DetallePedido::factory(20)->create();
    }
}
