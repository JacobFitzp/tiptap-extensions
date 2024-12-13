<?php

namespace App\Foundation\Github;

class Repository
{
    public string $full;

    public string $slug;

    public function __construct(public string $owner, public string $name)
    {
        // Include in serialization.
        $this->full = $this->full();
        $this->slug = $this->slug();
    }

    public function full(): string
    {
        return $this->owner.'/'.$this->name;
    }

    public function slug(): string
    {
        return $this->owner.'-'.$this->name;
    }

    public static function parse(string $repository): self
    {
        $fragments = explode('/', strtolower($repository));

        return new self($fragments[0], $fragments[1]);
    }
}
