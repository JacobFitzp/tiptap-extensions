<?php

namespace App\Foundation\Tags\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public static string $factory = TagFactory::class;

    protected $fillable = [
        'label',
        'slug',
    ];
}
