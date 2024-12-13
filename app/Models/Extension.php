<?php

namespace App\Models;

use App\Events\ExtensionCreated;
use App\Foundation\Github\Casts\RepositoryCast;
use App\Foundation\Tags\Concerns\Taggable;
use App\Models\Concerns\BelongsToUser;
use App\Models\Enums\ExtensionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Extension extends Model
{
    use BelongsToUser, HasFactory, Taggable;

    protected $dispatchesEvents = [
        'created' => ExtensionCreated::class,
    ];

    protected $fillable = [
        'title',
        'repository',
        'slug',
        'description',
        'content',
        'type',
        'published',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'repository' => RepositoryCast::class,
            'type' => ExtensionType::class,
            'use_readme' => 'boolean',
            'published' => 'boolean',
        ];
    }

    /**
     * Has many stars relationship.
     */
    public function stars(): HasMany
    {
        return $this->hasMany(ExtensionStar::class);
    }

    /**
     * Has many reviews relationship.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(ExtensionReview::class);
    }
}
