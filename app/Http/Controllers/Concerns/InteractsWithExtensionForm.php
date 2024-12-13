<?php

namespace App\Http\Controllers\Concerns;

use App\Foundation\Tags\Models\Tag;
use App\Models\User;

trait InteractsWithExtensionForm
{
    public function extensionFormProps(User $user): array
    {
        return [
            'tags' => Tag::all(),
            'repositories' => $user->github()->me()->repositories('maintainer'),
        ];
    }
}
