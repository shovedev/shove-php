<?php

namespace Shove\Tests\Feature\Queues;

use Saloon\Http\Faking\MockResponse;
use Shove\Data\Queue;
use Shove\Enums\QueueType;
use Shove\Requests\Queues\CreateRequest;
use Shove\Requests\Queues\DeleteRequest;
use Shove\Tests\TestCase;
use Shove\Tests\TestClient;

class QueuesTest extends TestCase
{
    use TestClient;

    public function test_can_create_a_new_queue_via_api()
    {
        $shove = $this->getConnector([
            CreateRequest::class => MockResponse::fixture('resources/queues/create')
        ]);

        $queue = $shove->queues()->create(
            name: 'test_queue',
            type: QueueType::Unicast
        );

        $this->assertInstanceOf(Queue::class, $queue);
    }

    public function test_can_delete_a_queue_via_api()
    {
        $shove = $this->getConnector([
            DeleteRequest::class => MockResponse::fixture('resources/queues/delete'),
        ]);

        $response = $shove->queues()->delete(
            name: 'test_queue'
        );

        $this->assertEquals(204, $response->status());
    }
}