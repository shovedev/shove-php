<?php

namespace Shove\Data;

use Shove\Enums\QueueType;

final readonly class Queue extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly QueueType $type
    ) {
    }
}