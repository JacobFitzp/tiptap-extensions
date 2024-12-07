<?php

namespace Database\Factories;

use App\Models\Extension;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExtensionTag>
 */
class ExtensionTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'extension_id' => static fn () => Extension::factory()->create(),
            'tag_id' => static fn () => Tag::factory()->create(),
        ];
    }
}
