<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'name' => fake()->words(rand(1, 3), true),
            'name' => fake()->words(2, true),
            'year' => fake()->year(),
            'cashOut' => fake()->numberBetween(1000000, 2000000000)
        ];
    }
}