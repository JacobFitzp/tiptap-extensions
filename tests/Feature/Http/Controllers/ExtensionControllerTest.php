<?php

use App\Foundation\Tags\Models\Tag;
use App\Models\Enums\ExtensionType;
use App\Models\Extension;
use App\Models\User;

$routes = [
    'extensions.submit' => [
        static fn () => route('extensions.submit'),
        'get',
    ],
    'extensions.manage' => [
        static fn () => route('extensions.manage', 'fake-extension'),
        'get',
        static fn () => Extension::factory()->create(['slug' => 'fake-extension']),
    ],
    'extensions.store' => [
        static fn () => route('extensions.store'),
        'post',
    ],
];

it('requires login', function (Closure $route, string $method, ?Closure $setup = null) {
    if (is_callable($setup)) {
        $setup();
    }
    $this->$method($route())
        ->assertRedirect('login');
})->with($routes);

it('validates create extension request', function (
    array $payload,
    array $expectedErrors,
    ?Closure $setup = null
) {
    if (is_callable($setup)) {
        $setup();
    }

    $this->actingAs(User::factory()->create())
        ->post(route('extensions.store'), $payload)
        ->assertSessionHasErrors($expectedErrors);
})->with([
    'missing required' => [
        [],
        [
            'title' => 'Please enter a title for your extension.',
            'description' => 'Please enter a description for your extension.',
            'repository' => 'Please select a GitHub repository for your extension.',
            'type' => 'Please select a type for your extension.',
        ],
    ],
    'title too short' => [
        ['title' => 'Test'],
        ['title' => 'The title must be at least 5 characters long.'],
    ],
    'title too long' => [
        ['title' => fake()->realTextBetween(256, 300)],
        ['title' => 'The title must be no more than 255 characters long.'],
    ],
    'description too long' => [
        ['description' => fake()->realTextBetween(1001, 1200)],
        ['description' => 'The description must be no more than 1000 characters long.'],
    ],
    'duplicate repository' => [
        ['repository' => 'fake/fake-repository'],
        ['repository' => 'The repository has already been taken.'],
        static fn () => Extension::factory()->create(['repository' => 'fake/fake-repository']),
    ],
    'invalid type' => [
        ['type' => 'hobnob'],
        ['type' => 'The selected type is invalid.'],
    ],
    'content missing when use_readme is unchecked' => [
        ['use_readme' => false],
        ['content' => 'You must provide content for your extension if you choose not to use the README.'],
    ],
    'too many tags' => [
        [
            'tags' => [
                ['slug' => 'fake-tag-1'],
                ['slug' => 'fake-tag-2'],
                ['slug' => 'fake-tag-3'],
                ['slug' => 'fake-tag-4'],
                ['slug' => 'fake-tag-5'],
                ['slug' => 'fake-tag-6'],
            ],
        ],
        ['tags' => 'The tags field must not have more than 5 items.'],
    ],
]);

it('can create an extension', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('extensions.store'), [
            'title' => 'Test extension',
            'description' => 'Test extension',
            'repository' => 'fake/fake-extension',
            'use_readme' => false,
            'content' => 'Test extension',
            'type' => ExtensionType::PROJECT->value,
        ])
        ->assertRedirectToRoute('extensions.manage', 'fake-fake-extension');

    $this->assertDatabaseHas('extensions', [
        'title' => 'Test extension',
        'description' => 'Test extension',
        'repository' => 'fake/fake-extension',
        'slug' => 'fake-fake-extension',
        'type' => ExtensionType::PROJECT->value,
    ]);
});

it('can associate tags with extension', function () {
    $tags = Tag::factory(4)
        ->create();

    $this->actingAs(User::factory()->create())
        ->post(route('extensions.store'), [
            'title' => 'Test extension',
            'description' => 'Test extension',
            'repository' => 'fake/fake-extension',
            'use_readme' => false,
            'content' => 'Test extension',
            'type' => ExtensionType::PROJECT->value,
            'tags' => $tags->modelKeys(),
        ])
        ->assertRedirectToRoute('extensions.manage', 'fake-fake-extension');

    $extension = Extension::latest()->first();

    $tags->each(function (Tag $tag) use ($extension) {
        $this->assertDatabaseHas('tagged', [
            'taggable_id' => $extension->id,
            'taggable_type' => $extension->getMorphClass(),
            'tag_id' => $tag->id,
        ]);
    });
});
