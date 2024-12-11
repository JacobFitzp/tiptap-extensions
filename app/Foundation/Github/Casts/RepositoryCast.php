<?php

namespace App\Foundation\Github\Casts;

use App\Foundation\Github\Repository;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class RepositoryCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): Repository
    {
        ray($value);

        return Repository::parse($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        return $value instanceof Repository
            ? $value->slug()
            : $value;
    }
}
