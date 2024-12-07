<?php

it('returns successful response', function () {
    $this->get(route('home'))
        ->assertOk();
});
