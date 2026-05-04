<?php

namespace Database\Factories;

use App\Models\Carrito;
use App\Models\Producto;
use App\Models\User;
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
            'id_producto' => Producto::all()->random()->id_producto,
            'id_user' => User::all()->random()->id,
            'cantidad' => $this->faker->numberBetween(1, 5),
        ];
    }
}
