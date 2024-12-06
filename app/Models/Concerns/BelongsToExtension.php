<?php

namespace App\Models\Concerns;

use App\Models\Extension;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToExtension
{
    /**
     * Belongs to extension relationship.
     */
    public function extension(): BelongsTo
    {
        return $this->belongsTo(Extension::class);
    }
}
