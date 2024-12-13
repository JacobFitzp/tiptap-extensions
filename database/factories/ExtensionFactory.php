<?php

namespace Database\Factories;

use App\Models\Enums\ExtensionType;
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
            'repository' => fake()->word.'/'.fake()->word,
            'slug' => fake()->word.'-'.fake()->word,
            'type' => fake()->randomElement(ExtensionType::cases()),
            'title' => fake()->word,
            'description' => fake()->sentence,
            'content' => fake()->text(500),
            'use_readme' => false,
            'published' => fake()->boolean,
        ];
    }
}
