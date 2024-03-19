<?php

namespace Shove\Requests\Queues;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Shove\Traits\Makeable;

class DeleteRequest extends Request implements HasBody
{
    use HasJsonBody;
    use Makeable;

    protected Method $method = Method::DELETE;

    public function __construct(protected string $name)
    {
    }

    protected function defaultBody(): array
    {
        return [
//            '_method' => 'DELETE',
            'name' => $this->name,
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/queues/'.$this->name;
    }
}