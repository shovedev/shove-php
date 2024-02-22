<?php

namespace Shove;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class JobsReadRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        public string $jobId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/jobs'.$this->jobId;
    }
}