<?php

namespace Tests\Traits;

use Github\Api\CurrentUser;
use Github\Api\Repo;
use Github\Client;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Before;

trait InteractsWithGithub
{
    #[Before]
    public function setupGithubMocks(): void
    {
        $currentUserMock = Mockery::mock(CurrentUser::class, function (MockInterface $mock) {
            $mock->shouldReceive('repositories')
                ->withAnyArgs()
                ->andReturn([]);
        });

        $repoMock = Mockery::mock(Repo::class, function (MockInterface $mock) {
            $mock->shouldReceive('readme')
                ->withAnyArgs()
                ->andReturn(fake()->realText());
        });

        $clientMock = Mockery::mock(
            Client::class,
            function (MockInterface $mock) use ($repoMock, $currentUserMock) {
                $mock->shouldReceive('repo')
                    ->andReturn($repoMock);
                $mock->shouldReceive('me')
                    ->withAnyArgs()
                    ->andReturn($currentUserMock);
                $mock->shouldReceive('authenticate')
                    ->withAnyArgs()
                    ->andReturn(true);
            }
        );

        app()->instance(Client::class, $clientMock);
    }
}
