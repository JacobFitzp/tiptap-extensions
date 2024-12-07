<?php

namespace Database\Factories;

use App\Models\Extension;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExtensionStar>
 */
class ExtensionStarFactory extends Factory
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
            'extension_id' => static fn () => Extension::factory()->create(),
        ];
    }
}
