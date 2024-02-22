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

    public function __construct(public string $name, public QueueType|string $type = QueueType::Multicast)
    {
    }

    public function resolveEndpoint(): string
    {
        return '/queues';
    }

    public function defaultBody(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
        ];
    }
}