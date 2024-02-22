<?php

namespace Shove\Tests\Queues;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Shove\QueuesCreateRequest;
use Shove\QueueType;
use Shove\ShoveConnector;
use Shove\Tests\TestCase;

class QueuesCreateTest extends TestCase
{
    public function test_can_create_a_new_queue_via_api()
    {
        $shove = $this->getConnector([
            QueuesCreateRequest::class => MockResponse::fixture('queues.create.success')
        ]);

        $request = new QueuesCreateRequest(
            name: 'test_queue',
            type: QueueType::Unicast
        );

        $response = $shove->send($request);

        $this->assertEquals(204, $response->status());
    }

    public function getConnector(array $mocks = []): ShoveConnector
    {
        return (new ShoveConnector(
            token: 'shove_pRBiQuNzjlkKbm5c2NpeinHBKuTbBYsqJZPOAX6Tc8aaa130',
            baseUrl: 'https://shove.test/api',
        ))->withMockClient(new MockClient($mocks));
    }

    protected function setUp(): void
    {
        parent::setUp();

        MockClient::destroyGlobal();
    }
}