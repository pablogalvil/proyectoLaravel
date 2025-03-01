<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\locutor>
 */
class locutorFactory extends Factory
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
            'edad' => $this->faker->numberBetween(1, 100),
            'email' => $this->faker->email(),
            'contrasenia' => $this->faker->password(),
            'imagen' => $this->faker->imageUrl()
        ];
    }
}
