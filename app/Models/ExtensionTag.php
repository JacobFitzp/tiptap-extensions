<?php

namespace App\Models;

use App\Models\Concerns\BelongsToExtension;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExtensionTag extends Model
{
    use BelongsToExtension, HasFactory;

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
