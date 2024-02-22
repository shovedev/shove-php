<?php
namespace Shove\Tests;

use Saloon\Http\Faking\MockClient;
use Shove\ShoveConnector;

trait TestClient
{
    public function getConnector(array $mocks = []): ShoveConnector
    {
        return (new ShoveConnector(
            token: 'test-key',
        ))->withMockClient(new MockClient($mocks));
    }

    protected function setUp(): void
    {
        parent::setUp();

        MockClient::destroyGlobal();
    }
}