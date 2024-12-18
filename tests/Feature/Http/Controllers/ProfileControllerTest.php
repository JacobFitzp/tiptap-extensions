<?php

use App\Models\User;

it('requires login', function () {
    $this->get(route('profile.show'))
        ->assertRedirectToRoute('login');
});

it('can render profile page', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('profile.show'))
        ->assertOk();
});
