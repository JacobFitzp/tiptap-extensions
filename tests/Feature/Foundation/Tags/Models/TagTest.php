<?php

use App\Foundation\Tags\Models\Tag;

it('can create a tag', function () {
    $tag = Tag::create([
        'label' => 'Test',
        'slug' => 'test',
    ]);

    expect($tag->label)->toBe('Test')
        ->and($tag->slug)->toBe('test');
});
