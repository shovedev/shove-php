<?php

declare(strict_types=1);

namespace Shove\Connector;

use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\HasTimeout;
use Shove\Traits\InteractsWithResources;
use Shove\Traits\Makeable;

class ShoveConnector extends Connector
{
    use HasTimeout;
    use Makeable;
    use InteractsWithResources;

    protected int $connectTimeout = 10;

    protected int $requestTimeout = 30;

    public function __construct(
        protected readonly string $token,
        protected ?string $baseUrl = null
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
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
}
