<?php

namespace App\Models;

use App\Models\Concerns\BelongsToExtension;
use App\Models\Concerns\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtensionReview extends Model
{
    use BelongsToExtension, BelongsToUser, HasFactory;

    protected $fillable = [
        'user_id',
        'extension_id',
        'comment',
        'rating',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'rating' => 'integer',
        ];
    }
}
