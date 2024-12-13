<?php

namespace Tests;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Traits\InteractsWithGithub;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithGithub, LazilyRefreshDatabase;
}
