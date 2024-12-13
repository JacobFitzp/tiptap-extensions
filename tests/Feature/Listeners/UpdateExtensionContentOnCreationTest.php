<?php

use App\Events\ExtensionCreated;
use App\Jobs\UpdateExtensionContent;
use App\Listeners\UpdateExtensionContentOnCreation;
use App\Models\Extension;

it('listens for extension created event', function () {
    Event::fake();
    Event::assertListening(
        ExtensionCreated::class,
        UpdateExtensionContentOnCreation::class
    );
});

it('dispatches job if use_readme is enabled', function () {
    Bus::fake([UpdateExtensionContent::class]);
    Extension::factory()->create([
        'use_readme' => true,
    ]);

    Bus::assertDispatched(UpdateExtensionContent::class);
});

it('doesnt dispatch job if use_readme is disabled', function () {
    Bus::fake([UpdateExtensionContent::class]);
    Extension::factory()->create([
        'use_readme' => false,
    ]);

    Bus::assertNotDispatched(UpdateExtensionContent::class);
});
