<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\invitado>
 */
class invitadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'ocupacion' => $this->faker->text(),
            'imagen' => $this->faker->imageUrl(),
            'descripcion' => $this->faker->text()
        ];
    }
}
