<?php

namespace Shove\Data;


final readonly class Job extends Data
{
    public function __construct(
        public readonly ?string $queue = null,
        public readonly ?array $headers = null,
        public readonly ?array $body = null
    ) {
    }
}