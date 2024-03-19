<?php

namespace Shove\Requests\Jobs;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ReadRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    public function __construct(
        public string $id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/jobs/'.$this->id;
    }
}