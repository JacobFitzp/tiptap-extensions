<?php

it('can render profile page', function () {
    $this->get(route('profile.show'))
        ->assertOk();
});
