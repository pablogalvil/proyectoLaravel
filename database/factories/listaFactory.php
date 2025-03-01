<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\lista>
 */
class listaFactory extends Factory
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
            'numPodcast' => $this->faker->randomNumber(2),
            'duracion' => $this->faker->numberBetween(30, 180),
            'fechaReproduccion' => $this->faker->date(),
            'estado' => $this->faker->boolean(),
            'descripcion' => $this->faker->text()
        ];
    }
}
