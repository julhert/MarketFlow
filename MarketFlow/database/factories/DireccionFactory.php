<?php

namespace Database\Factories;

use App\Models\Direccion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Direccion>
 */
class DireccionFactory extends Factory
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
            'ciudad' => $this->faker->city(),
            'calle' => $this->faker->streetName(),
            'codigo_postal' => $this->faker->postcode(),
            'numero_interior' => $this->faker->buildingNumber(),
            'numero_exterior' => $this->faker->buildingNumber(),
            'estado' => $this->faker->state(),
            'colonia' => $this->faker->streetSuffix(),
            'refencias' => $this->faker->sentence(),
        ];
    }
}
