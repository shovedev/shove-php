<?php

namespace Shove;

use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\HasTimeout;

class ShoveConnector extends Connector
{
    use HasTimeout;

    protected int $connectTimeout = 10;

    protected int $requestTimeout = 30;

    public function __construct(
        public readonly string $token,
        public ?string $baseUrl = null
    ) {
    }

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl ?? 'https://shove.dev/api';
    }

    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator($this->token);
    }

    protected function defaultHeaders(): array
    {
        return [
////            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
}