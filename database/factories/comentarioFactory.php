<?php

namespace Database\Factories;

use App\Models\Podcast;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\comentario>
 */
class comentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->text(),
            'fecha' => $this->faker->date(),
            'usuario_id' => Usuario::factory(),
            'podcast_id' => Podcast::factory(),

        ];
    }
}
