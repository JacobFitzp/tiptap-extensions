<?php

namespace Database\Factories;

use App\Foundation\Tags\Models\Tag;
use App\Foundation\Tags\Models\Tagged;
use App\Models\Extension;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Foundation\Tags\Models\Tagged>
 */
class TaggedFactory extends Factory
{
    protected $model = Tagged::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'taggable_id' => static fn () => Extension::factory()->create(),
            'taggable_type' => 'extension',
            'tag_id' => static fn () => Tag::factory()->create(),
        ];
    }
}
