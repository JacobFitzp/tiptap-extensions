<?php

namespace Tests\Traits;

use Github\Api\Repo;
use Github\Client;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Before;

trait InteractsWithGithub
{
    #[Before]
    public function setupGithubMocks(): void
    {
        $repoMock = \Mockery::mock(Repo::class, function (MockInterface $mock) {
            $mock->shouldReceive('readme')
                ->withAnyArgs()
                ->andReturn(fake()->realText());
        });

        $clientMock = \Mockery::mock(Client::class, function (MockInterface $mock) use ($repoMock) {
            $mock->shouldReceive('repo')
                ->andReturn($repoMock);
        });

        app()->instance(Client::class, $clientMock);
    }
}
