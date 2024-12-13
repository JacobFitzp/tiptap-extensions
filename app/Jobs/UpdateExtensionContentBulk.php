<?php

namespace App\Jobs;

use App\Models\Extension;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateExtensionContentBulk implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Extension::query()
            ->where('use_readme', true)
            ->each(function (Extension $extension): void {
                UpdateExtensionContent::dispatch($extension);
            });
    }
}
