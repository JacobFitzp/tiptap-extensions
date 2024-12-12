<?php

namespace Database\Factories;

use App\Foundation\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Foundation\Tags\Models\Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'label' => fake()->word,
            'slug' => fake()->slug,
        ];
    }
}
