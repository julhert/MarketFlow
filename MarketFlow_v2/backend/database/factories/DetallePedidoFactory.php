<?php

namespace Database\Factories;

use App\Models\DetallePedido;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DetallePedido>
 */
class DetallePedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pedido' => \App\Models\Pedidos::all()->random()->id_pedido, // Asocia a un pedido existenteq
            'id_producto' => \App\Models\Productos::all()->random()->id_producto, // Asocia a un producto existente
            'cantidad' => $this->faker->numberBetween(1, 10),
            'precio_unitario' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
