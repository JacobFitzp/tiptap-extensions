<?php

use App\Foundation\Tags\Models\Tag;
use App\Foundation\Tags\Models\Tagged;
use App\Models\Extension;

it('can create extension tag', function () {
    $extension = Extension::factory()->create();
    $tag = Tag::factory()->create();
    $extensionTag = $extension->tags()->create([
        'tag_id' => $tag->id,
    ]);

    expect($extensionTag->tag_id)->toBe($tag->id)
        ->and($extensionTag->taggable_id)->toBe($extension->id);
});

it('can get taggable relationship', function () {
    $extension = Extension::factory()->create();
    $extensionTag = Tagged::factory()->create([
        'taggable_id' => $extension->id,
        'taggable_type' => $extension->getMorphClass(),
    ]);

    expect($extensionTag->taggable)->toBeInstanceOf(Extension::class)
        ->and($extensionTag->taggable->id)->toBe($extension->id);
});

it('can get tag relationship', function () {
    $tag = Tag::factory()->create();
    $extensionTag = Tagged::factory()->create([
        'tag_id' => $tag->id,
    ]);

    expect($extensionTag->tag)->toBeInstanceOf(Tag::class)
        ->and($extensionTag->tag->id)->toBe($tag->id);
});
