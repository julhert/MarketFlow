<?php

namespace Database\Factories;

use App\Models\Comentario;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comentario>
 */
class ComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => User::inRandomOrder()->first()->id,
            'id_producto' => Producto::inRandomOrder()->first()->id_producto,
            'comentario' => $this->faker->sentence(),
        ];
    }
}
