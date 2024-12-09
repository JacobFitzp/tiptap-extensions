<?php

use App\Models\Extension;
use App\Models\User;
use Github\AuthMethod;
use Github\Client;

it('can create user', function () {
    $user = User::create([
        'github_id' => 1234,
        'github_token' => 'fake-token',
        'github_refresh_token' => 'fake-refresh-token',
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'avatar' => $avatar = fake()->imageUrl,
    ]);

    expect($user->github_id)->toBe(1234)
        ->and($user->github_token)->toBe('fake-token')
        ->and($user->github_refresh_token)->toBe('fake-refresh-token')
        ->and($user->name)->toBe('John Doe')
        ->and($user->email)->toBe('john.doe@example.com')
        ->and($user->avatar)->toBe($avatar);
});

it('can get extensions relationship', function () {
    $user = User::factory()->create();
    $extensions = Extension::factory(4)->create([
        'user_id' => $user->id,
    ]);

    expect($user->extensions)->toHaveCount(4)
        ->and($user->extensions->modelKeys())->toBe($extensions->modelKeys());
});

it('casts points to integer', function () {
    $user = User::factory()->create([
        'points' => 123,
    ]);

    expect($user->points)->toBe(123);
});

it('can get github client instance', function () {
    $user = User::factory()->create([
        'github_token' => 'fake-token',
    ]);

    $mock = Mockery::mock(Client::class);
    $mock->shouldReceive('authenticate')
        ->with('fake-token', null, AuthMethod::ACCESS_TOKEN);
    app()->instance(Client::class, $mock);

    expect($user->github())->toBeInstanceOf(Client::class);
});
