<?php

namespace Shove;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class JobsCreateRequest extends Request implements HasBody
{
    use HasJsonBody;

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

    public function resolveEndpoint(): string
    {
        return '/i';
    }

    public function defaultBody(): array
    {
        return [
            'queue' => $this->data->queue,
            'headers' => $this->data->headers,
            'payload' => $this->data->body,
        ];
    }

    public function withHeaders(array $headers): static
    {
        $this->jobHeaders = $headers;

        return $this;
    }

    public function withPayload(array $payload): static
    {
        $this->jobBody = $payload;

        return $this;
    }

    public function onQueue(string $queue): static
    {
        $this->queue = $queue;

        return $this;
    }
}