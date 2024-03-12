<?php

namespace Shove;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class JobsCreateRequest extends Request implements HasBody
{
    use HasJsonBody;
    use Makeable;

    protected Method $method = Method::POST;

    protected JobsCreateData $data;

    public function __construct(
        ?string $queue = null,
        ?array $headers = null,
        ?array $body = null
    ) {
        $this->data = new JobsCreateData(
            queue: $queue,
            headers: $headers,
            body: $body
        );
    }

    public function getData(): JobsCreateData
    {
        return $this->data;
    }

    public function resolveEndpoint(): string
    {
        return '/jobs';
    }

    public function defaultBody(): array
    {
        return [
            'queue' => $this->data->queue,
            'headers' => $this->data->headers,
            'body' => $this->data->body,
        ];
    }
}