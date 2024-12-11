<?php

namespace App\Foundation\Github;

class Repository
{
    public function __construct(public string $owner, public string $name) {}

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
