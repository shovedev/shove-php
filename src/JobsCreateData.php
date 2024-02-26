<?php

namespace Shove;

class JobsCreateData
{
    public function __construct(
        public readonly ?string $queue = null,
        public readonly ?array $headers = null,
        public readonly ?array $body = null
    ) {
    }
}