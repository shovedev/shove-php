<?php

namespace Shove;

trait Makeable
{
    public static function make(...$args): static
    {
        return new static(...$args);
    }
}