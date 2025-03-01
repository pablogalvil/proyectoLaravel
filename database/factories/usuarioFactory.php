<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\usuario;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\usuario>
 */
class usuarioFactory extends Factory
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
            'contrasenia' => $this->faker->password(),
            'email' => $this->faker->email(),
            'fechaRegistro' => $this->faker->date(),
            'imagen' => $this->faker->imageUrl()
        ];
    }
}
