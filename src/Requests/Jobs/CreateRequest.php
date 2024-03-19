<?php

namespace Shove\Requests\Jobs;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Shove\Data\Job;
use Shove\Traits\Makeable;

class CreateRequest extends Request implements HasBody
{
    use HasJsonBody;
    use Makeable;

    protected Method $method = Method::POST;

    protected Job $job;

    public function __construct(
        ?string $queue = null,
        ?array $headers = null,
        ?array $body = null
    ) {
        $this->job = new Job(
            queue: $queue,
            headers: $headers,
            body: $body
        );
    }

    public function resolveEndpoint(): string
    {
        return '/jobs';
    }

    public function defaultBody(): array
    {
        return [
            'queue' => $this->job->queue,
            'headers' => $this->job->headers,
            'body' => $this->job->body,
        ];
    }
}