<?php

use App\Models\Extension;
use App\Models\ExtensionStar;
use App\Models\User;

it('can create extension star', function () {
    $extension = Extension::factory()->create();
    $user = User::factory()->create();

    $star = $extension->stars()->create([
        'user_id' => $user->id,
    ]);

    expect($star->extension_id)->toBe($extension->id)
        ->and($star->user_id)->toBe($user->id);
});

it('can get extension relationship', function () {
    $extension = Extension::factory()->create();
    $star = ExtensionStar::factory()->create([
        'extension_id' => $extension->id,
    ]);

    expect($star->extension)->toBeInstanceOf(Extension::class)
        ->and($star->extension->id)->toBe($extension->id);
});

it('can get user relationship', function () {
    $user = User::factory()->create();
    $star = ExtensionStar::factory()->create([
        'user_id' => $user->id,
    ]);

    expect($star->user)->toBeInstanceOf(User::class)
        ->and($star->user->id)->toBe($user->id);
});
