<?php

use App\Models\Extension;
use App\Models\ExtensionReview;
use App\Models\User;

it('can create extension review', function () {
    $user = User::factory()->create();
    $extension = Extension::factory()->create();
    $review = $extension->reviews()->create([
        'user_id' => $user->id,
        'rating' => 4,
        'comment' => 'Great extension!',
    ]);

    expect($review->extension_id)->toBe($extension->id)
        ->and($review->user_id)->toBe($user->id)
        ->and($review->comment)->toBe('Great extension!')
        ->and($review->rating)->toBe(4);
});

it('can get extension relationship', function () {
    $extension = Extension::factory()->create();
    $review = ExtensionReview::factory()->create([
        'extension_id' => $extension->id,
    ]);

    expect($review->extension)->toBeInstanceOf(Extension::class)
        ->and($review->extension->id)->toBe($extension->id);
});

it('can get user relationship', function () {
    $user = User::factory()->create();
    $review = ExtensionReview::factory()->create([
        'user_id' => $user->id,
    ]);

    expect($review->user)->toBeInstanceOf(User::class)
        ->and($review->user->id)->toBe($user->id);
});

it('casts rating to integer', function () {
    $review = ExtensionReview::factory()->create([
        'rating' => 3,
    ]);

    expect($review->rating)->toBe(3);
});
