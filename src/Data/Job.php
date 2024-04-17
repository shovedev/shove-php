<?php

namespace Shove\Data;

final readonly class Job extends Data
{
    public function __construct(
        public readonly string $queue = 'default',
        public readonly array $headers = [],
        public readonly array $body = []
    ) {
    }
}