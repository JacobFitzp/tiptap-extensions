<?php

namespace App\Listeners;

use App\Events\ExtensionCreated;
use App\Jobs\UpdateExtensionContent;

class UpdateExtensionContentOnCreation
{
    /**
     * Handle the event.
     */
    public function handle(ExtensionCreated $event): void
    {
        // Dispatch event to update content if use_readme is enabled.
        if ($event->extension->use_readme) {
            UpdateExtensionContent::dispatch($event->extension);
        }
    }
}
