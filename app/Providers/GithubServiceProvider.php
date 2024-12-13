<?php

namespace App\Providers;

use Github\AuthMethod;
use Github\Client;
use Illuminate\Support\ServiceProvider;

class GithubServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Client::class, function () {
            $client = new Client;
            $client->authenticate(config('services.github.client_id'), authMethod: AuthMethod::CLIENT_ID);

            return $client;
        });
    }
}
