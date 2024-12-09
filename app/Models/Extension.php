<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUser;
use App\Models\Enums\ExtensionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Extension extends Model
{
    use BelongsToUser, HasFactory;

    protected $fillable = [
        'title',
        'repository',
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
            'type' => ExtensionType::class,
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

    /**
     * Has many tags relationship.
     */
    public function tags(): HasMany
    {
        return $this->hasMany(ExtensionTag::class);
    }
}
