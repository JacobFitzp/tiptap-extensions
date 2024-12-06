<?php

namespace App\Models;

use App\Models\Concerns\BelongsToExtension;
use App\Models\Concerns\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtensionStar extends Model
{
    use BelongsToExtension, BelongsToUser, HasFactory;
}
