<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\podcast;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\episodio>
 */
class episodioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->text(),
            'audio' => $this->faker->text(),
            'descripcion' => $this->faker->text(),
            'podcast_id' => Podcast::factory(),
        ];
    }
}
