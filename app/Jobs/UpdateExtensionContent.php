<?php

namespace App\Jobs;

use App\Models\Extension;
use Github\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateExtensionContent implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Extension $extension) {}

    /**
     * Execute the job.
     */
    public function handle(Client $client): void
    {
        $this->extension
            ->update([
                'content' => $client->repo()
                    ->readme(
                        $this->extension->repository->owner,
                        $this->extension->repository->name
                    ),
            ]);
    }
}
