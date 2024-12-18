<?php

namespace App\Providers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\ServiceProvider;

class MessageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        RedirectResponse::macro('withMessage', function (string $message, string $severity = 'info', ?string $icon = null) {
            return $this->with('message.content', $message)
                ->with('message.severity', $severity)
                ->with('message.icon', $icon);
        });
    }
}
