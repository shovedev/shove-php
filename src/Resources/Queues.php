<?php

namespace Shove\Resources;

use Shove\Data\Queue;
use Shove\Enums\QueueType;
use Shove\Requests\Queues\CreateRequest;
use Shove\Requests\Queues\DeleteRequest;

class Queues extends Resource
{
    public function create(string $name, QueueType|string $type = QueueType::Multicast)
    {
        $response = $this->connector->send(new CreateRequest(name: $name, type: $type));

        return new Queue(
            name: $response->json('name'),
            type: QueueType::from($response->json('type'))
        );
    }

    public function delete(string $name)
    {
        return $this->connector->send(new DeleteRequest(name: $name));
    }
}