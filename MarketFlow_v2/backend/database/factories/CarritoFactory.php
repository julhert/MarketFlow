<?php

namespace Database\Factories;

use App\Models\Carrito;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Carrito>
 */
class CarritoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_producto' => \App\Models\Productos::all()->random()->id_producto,
            'id_user' => \App\Models\User::all()->random()->id,
            'cantidad' => $this->faker->numberBetween(1, 5),
        ];
    }
}
