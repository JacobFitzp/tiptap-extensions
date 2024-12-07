<?php

use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;
use Mockery\MockInterface;

function setupMock()
{
    $user = Mockery::mock(User::class, static function (MockInterface $mock) {
        $mock->shouldReceive('getId')->andReturn(12345);
        $mock->shouldReceive('getName')->andReturn('John Doe');
        $mock->shouldReceive('getEmail')->andReturn('john.doe@example.com');
        $mock->shouldReceive('getAvatar')->andReturn(fake()->imageUrl);
        $mock->token = 'fake-token';
        $mock->refreshToken = 'fake-refresh-token';
    });

    $provider = Mockery::mock(Provider::class, static function (MockInterface $mock) use ($user) {
        $mock->shouldReceive('user')->andReturn($user);
    });

    Socialite::shouldReceive('driver')
        ->with('github')
        ->andReturn($provider);
}

it('redirects to github', function () {
    $this->get(route('auth.redirect'))
        ->assertRedirect();
});

it('handles callback', function () {
    setupMock();

    $this->get(route('auth.callback'))
        ->assertRedirect(route('home'));

    $this->assertDatabaseHas('users', [
        'github_id' => 12345,
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
    ]);

    expect(auth()->user()->github_id)->toBe(12345);
});

it('can logout', function () {
    auth()->login(\App\Models\User::factory()->create());

    $this->get(route('auth.logout'))
        ->assertRedirect(route('home'));

    expect(auth()->user())->toBeNull();
});
