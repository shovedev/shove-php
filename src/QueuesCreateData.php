<?php

namespace Shove;

class QueuesCreateData
{
    public function __construct(
        public readonly string $name,
        public readonly QueueType|string $type = QueueType::Multicast
    ) {
    }
}
