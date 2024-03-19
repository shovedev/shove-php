<?php

namespace Shove\Tests\Unit;

use Saloon\Http\Faking\MockResponse;
use Shove\Data\Queue;
use Shove\Enums\QueueType;
use Shove\Requests\Queues\CreateRequest;
use Shove\Requests\Queues\DeleteRequest;
use Shove\Tests\TestCase;
use Shove\Tests\TestClient;

class QueueTest extends TestCase
{
    public function test_can_create_new_queue_data_objects()
    {
        $queue = new Queue(
            name: 'test_queue',
            type: QueueType::Unicast
        );

        $this->assertEquals('test_queue', $queue->name);
        $this->assertEquals(QueueType::Unicast, $queue->type);
    }
}