<?php

namespace Shove;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class QueuesDeleteRequest extends Request implements HasBody
{
    use HasJsonBody;
    use Makeable;

    protected Method $method = Method::DELETE;

    public function __construct(public string $ulid)
    {
    }

    public function resolveEndpoint(): string
    {
        return '/queues/'.$this->ulid;
    }
}