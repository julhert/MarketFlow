<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\Direccion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => User::all()->random()->id,
            'id_direccion' => Direccion::all()->random()->id_direccion,
            'folio' => $this->faker->unique()->numerify('FOLIO-#####'),
            'metodoPago' => $this->faker->randomElement(['Tarjeta de crédito', 'PayPal', 'Transferencia bancaria']),
            'totalCompra' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
