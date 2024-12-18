<?php

namespace App\Foundation\Tags\Concerns;

use App\Foundation\Tags\Models\Tagged;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Taggable
{
    /**
     * Attach multiple tags from request array.
     */
    public function attachTags(array $tags): void
    {
        foreach ($tags as $tag) {
            $this->tagged()->create(['tag_id' => $tag]);
        }
    }

    /**
     * Has many tags relationship.
     */
    public function tagged(): MorphMany
    {
        return $this->morphMany(Tagged::class, 'taggable');
    }
}
