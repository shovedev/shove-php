<?php

namespace Shove;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class QueuesCreateRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    protected QueuesCreateData $data;

    public function __construct(string $name, QueueType|string $type = QueueType::Multicast)
    {
        $this->data = new QueuesCreateData(
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
            'name' => $this->data->name,
            'type' => $this->data->type,
        ];
    }
}