<?php

use App\Models\Extension;
use App\Models\ExtensionTag;
use App\Models\Tag;

it('can create extension tag', function () {
    $extension = Extension::factory()->create();
    $tag = Tag::factory()->create();
    $extensionTag = $extension->tags()->create([
        'tag_id' => $tag->id,
    ]);

    expect($extensionTag->tag_id)->toBe($tag->id)
        ->and($extensionTag->extension_id)->toBe($extension->id);
});

it('can get extension relationship', function () {
    $extension = Extension::factory()->create();
    $extensionTag = ExtensionTag::factory()->create([
        'extension_id' => $extension->id,
    ]);

    expect($extensionTag->extension)->toBeInstanceOf(Extension::class)
        ->and($extensionTag->extension->id)->toBe($extension->id);
});

it('can get tag relationship', function () {
    $tag = Tag::factory()->create();
    $extensionTag = ExtensionTag::factory()->create([
        'tag_id' => $tag->id,
    ]);

    expect($extensionTag->tag)->toBeInstanceOf(Tag::class)
        ->and($extensionTag->tag->id)->toBe($tag->id);
});
