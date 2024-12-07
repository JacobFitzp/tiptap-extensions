<?php

use App\Models\Extension;
use App\Models\ExtensionReview;
use App\Models\ExtensionStar;
use App\Models\ExtensionTag;
use App\Models\User;

it('can create extension', function () {
    $user = User::factory()->create();
    $extension = $user->extensions()->create([
        'title' => 'Test Extension',
        'repository' => 'test/fake-extension',
        'description' => 'This is a test extension',
        'content' => 'Test content',
    ]);

    expect($extension->user_id)->toBe($user->id)
        ->and($extension->title)->toBe('Test Extension')
        ->and($extension->repository)->toBe('test/fake-extension')
        ->and($extension->description)->toBe('This is a test extension')
        ->and($extension->content)->toBe('Test content');
});

it('can get user relationship', function () {
    $extension = Extension::factory()->create();
    expect($extension->user)->toBeInstanceOf(User::class);
});

it('can get stars relationship', function () {
    $extension = Extension::factory()->create();
    $stars = ExtensionStar::factory(4)->create([
        'extension_id' => $extension->id,
    ]);

    expect($extension->stars)->toHaveCount(4)
        ->and($extension->stars->modelKeys())->toBe($stars->modelKeys());
});

it('can get reviews relationship', function () {
    $extension = Extension::factory()->create();
    $reviews = ExtensionReview::factory(4)->create([
        'extension_id' => $extension->id,
    ]);

    expect($extension->reviews)->toHaveCount(4)
        ->and($extension->reviews->modelKeys())->toBe($reviews->modelKeys());
});

it('can get tags relationship', function () {
    $extension = Extension::factory()->create();
    $tags = ExtensionTag::factory(4)->create([
        'extension_id' => $extension->id,
    ]);

    expect($extension->tags)->toHaveCount(4)
        ->and($extension->tags->modelKeys())->toBe($tags->modelKeys());
});
