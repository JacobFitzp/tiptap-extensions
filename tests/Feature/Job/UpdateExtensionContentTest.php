<?php

use App\Models\Extension;
use Github\Api\Repo;
use Github\Client;
use Mockery\MockInterface;

it('updates extension content', function () {
    $repoMock = Mockery::mock(Repo::class, function (MockInterface $mock) {
        $mock->shouldReceive('readme')
            ->withAnyArgs()
            ->andReturn('Hobnob');
    });

    $clientMock = Mockery::mock(Client::class, function (MockInterface $mock) use ($repoMock) {
        $mock->shouldReceive('repo')
            ->andReturn($repoMock);
    });

    app()->instance(Client::class, $clientMock);

    $extension = Extension::factory()->create([
        'use_readme' => true,
        'content' => '',
    ]);

    expect($extension->refresh()->content)->toBe('Hobnob');
});
