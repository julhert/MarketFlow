<?php

namespace Database\Factories;

use App\Models\Comentarios;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comentarios>
 */
class ComentariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'id_user' => \App\Models\User::inRandomOrder()->first()->id,
        'id_producto' => \App\Models\Productos::inRandomOrder()->first()->id_producto,
        'comentario' => $this->faker->sentence(),
    ];
    }
}
