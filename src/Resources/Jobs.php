<?php

namespace Shove\Resources;

use Shove\Requests\Jobs\CreateRequest;
use Shove\Requests\Jobs\ReadRequest;

class Jobs extends Resource
{
    public function create(string $queue, array $headers, array $body)
    {
        return $this->connector->send(new CreateRequest(queue: $queue, headers: $headers, body: $body));
    }

    public function get(string $id)
    {
        return $this->connector->send(new ReadRequest(id: $id));
    }
}