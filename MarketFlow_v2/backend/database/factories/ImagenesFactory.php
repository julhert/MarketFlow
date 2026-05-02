<?php

namespace Database\Factories;

use App\Models\Imagenes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Imagenes>
 */
class ImagenesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_producto' => \App\Models\Productos::factory(),
            'portada' => $this->faker->randomElement(['principal', 'secundaria']),
            'rutaImagen' => $this->faker->imageUrl(640, 480, 'products', true), // Genera una URL de imagen aleatoria
        ];
    }
}
