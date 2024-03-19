<?php
namespace Shove\Tests;

use Saloon\Http\Faking\MockClient;
use Shove\Connector\ShoveConnector;

trait TestClient
{
    public function getConnector(array $mocks = []): ShoveConnector
    {
        return (new ShoveConnector(
            token: '5ldvAuRgwl9icnPSyr6LhQF9S9PhyEZLMvNx9gW215d88bbb',
            baseUrl: 'https://shove.test/api'
        ))->withMockClient(new MockClient($mocks));
    }

    protected function setUp(): void
    {
        parent::setUp();

        MockClient::destroyGlobal();
    }
}