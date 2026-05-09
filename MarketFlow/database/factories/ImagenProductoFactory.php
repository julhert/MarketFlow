<?php

namespace Database\Factories;

use App\Models\ImagenProducto;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ImagenProducto>
 */
class ImagenProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_producto' => Producto::factory(),
            'portada' => $this->faker->boolean(),
            'rutaImagen' => $this->faker->imageUrl(640, 480, 'products', true), // Genera una URL de imagen aleatoria
        ];
    }
}
