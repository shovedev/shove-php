<?php

namespace Shove\Requests\Queues;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Shove\Data\Queue;
use Shove\Data\QueuesCreateData;
use Shove\Enums\QueueType;
use Shove\Traits\Makeable;

class CreateRequest extends Request implements HasBody
{
    use HasJsonBody;
    use Makeable;

    protected Method $method = Method::POST;

    protected Queue $queue;

    public function __construct(string $name, QueueType|string $type = QueueType::Multicast)
    {
        $this->queue = new Queue(
            name: $name,
            type: $type
        );
    }

    public function resolveEndpoint(): string
    {
        return '/queues';
    }

    public function defaultBody(): array
    {
        return [
            'name' => $this->queue->name,
            'type' => $this->queue->type,
        ];
    }
}