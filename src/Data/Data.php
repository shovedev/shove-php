<?php

namespace Shove\Data;

use BackedEnum;
use DateTimeImmutable;
use Illuminate\Contracts\Support\Arrayable;
use Stringable;

abstract readonly class Data implements Arrayable, Stringable
{
    public static function fromArray(array $properties): static
    {
        return new static(...$properties);
    }

    public function toArray(): array
    {
        $result = [];

        $properties = get_object_vars($this);

        foreach ($properties as $property => $value) {
            if ($value instanceof Arrayable) {
                $value = $value->toArray();
            }

            if ($value instanceof DateTimeImmutable) {
                $value = $value->format('Y-m-d\TH:i:s.v\Z');
            }

            if ($value instanceof BackedEnum) {
                $value = $value->value;
            }

            $result[$property] = $value;
        }

        return $result;
    }

    public function __toString(): string
    {
        return json_encode($this->toArray()) ?: '';
    }
}