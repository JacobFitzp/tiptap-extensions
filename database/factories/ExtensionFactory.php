<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Extension>
 */
class ExtensionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => static fn () => User::factory()->create(),
            'repository' => fake()->word . '/' . fake()->word,
            'title' => fake()->word,
            'description' => fake()->sentence,
            'content' => fake()->text(500),
        ];
    }
}
