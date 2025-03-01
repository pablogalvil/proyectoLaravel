<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\podcast>
 */
class podcastFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'duracion' => $this->faker->numberBetween(30, 180),
            'nombre' => $this->faker->name(),
            'imagen' => $this->faker->imageUrl(),
            'descripcion' => $this->faker->text(),
            'fechaPublicacion' => $this->faker->date()
        ];
    }
}
