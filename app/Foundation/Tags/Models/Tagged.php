<?php

namespace App\Foundation\Tags\Models;

use Database\Factories\TaggedFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Tagged extends Model
{
    use HasFactory;

    protected $table = 'tagged';

    public static string $factory = TaggedFactory::class;

    protected $fillable = [
        'tag_id',
        'extension_id',
    ];

    public function taggable(): MorphTo
    {
        return $this->morphTo('taggable');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
