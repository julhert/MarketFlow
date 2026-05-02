<?php

namespace Database\Factories;

use App\Models\Productos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Productos>
 */
class ProductosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_categoria' => \App\Models\Categorias::all()->random()->id_categoria,
            'id_user' => \App\Models\User::all()->random()->id,
            'nombre' => $this->faker->sentence(2),
            'descripcion' => $this->faker->paragraph(),
            'stock' => $this->faker->numberBetween(0, 100),
            'precio' => $this->faker->randomFloat(2, 50, 5000),
            'activo' => true,
        ];
    }
}
