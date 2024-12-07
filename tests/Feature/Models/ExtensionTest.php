<?php

use App\Models\Extension;
use App\Models\ExtensionReview;
use App\Models\ExtensionStar;
use App\Models\User;

it('can create extension', function () {
    $user = User::factory()->create();
    $extension = $user->extensions()->create([
        'title' => 'Test Extension',
        'repository' => 'test/fake-extension',
        'description' => 'This is a test extension',
        'content' => 'Test content',
    ]);

    $this->assertSame($user->id, $extension->user_id);
    $this->assertSame('Test Extension', $extension->title);
    $this->assertSame('test/fake-extension', $extension->repository);
    $this->assertSame('This is a test extension', $extension->description);
    $this->assertSame('Test content', $extension->content);
});

it('can get user relationship', function () {
    $extension = Extension::factory()->create();
    $this->assertInstanceOf(User::class, $extension->user);
});

it('can get stars relationship', function () {
    $extension = Extension::factory()->create();
    $stars = ExtensionStar::factory(4)->create([
        'extension_id' => $extension->id,
    ]);

    $this->assertCount(4, $extension->stars);
    $this->assertSame($stars->modelKeys(), $extension->stars->modelKeys());
});

it('can get reviews relationship', function () {
    $extension = Extension::factory()->create();
    $reviews = ExtensionReview::factory(4)->create([
        'extension_id' => $extension->id,
    ]);

    $this->assertCount(4, $extension->reviews);
    $this->assertSame($reviews->modelKeys(), $extension->reviews->modelKeys());
});
