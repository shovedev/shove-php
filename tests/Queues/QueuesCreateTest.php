<?php

namespace Shove\Tests\Queues;

use Saloon\Http\Faking\MockResponse;
use Shove\QueuesCreateRequest;
use Shove\QueuesDeleteRequest;
use Shove\QueueType;
use Shove\Tests\TestCase;
use Shove\Tests\TestClient;

class QueuesCreateTest extends TestCase
{
    use TestClient;

    public function test_can_create_a_new_queue_via_api()
    {
        $shove = $this->getConnector([
            QueuesCreateRequest::class => MockResponse::make('', 204)
        ]);

        $request = new QueuesCreateRequest(
            name: 'test_queue',
            type: QueueType::Unicast
        );

        $response = $shove->send($request);

        $this->assertEquals(204, $response->status());
    }

    public function test_can_update_a_new_queue_via_api()
    {
        $shove = $this->getConnector([
            QueuesCreateRequest::class => MockResponse::make('', 204)
        ]);

        $request = QueuesCreateRequest::make(
            name: 'test_queue',
            type: QueueType::Unicast
        );

        $response = $shove->send($request);

        $this->assertEquals(204, $response->status());
    }

    public function test_can_delete_a_queue_via_api()
    {
        $shove = $this->getConnector([
            QueuesDeleteRequest::class => MockResponse::make('', 204)
        ]);

        $request = new QueuesDeleteRequest(
            ulid: 'test_queue',
        );

        $response = $shove->send($request);

        $this->assertEquals(204, $response->status());
    }
}