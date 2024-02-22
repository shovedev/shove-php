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

    public function __construct(
        public ?string $queue = null,
        public ?array $jobHeaders = null,
        public ?array $jobBody = null
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/jobs';
    }

    public function defaultBody(): array
    {
        return [
            'queue' => $this->queue,
            'headers' => $this->jobHeaders,
            'payload' => $this->jobBody,
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