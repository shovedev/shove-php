<?php

namespace Shove\Tests\Unit;

use Saloon\Http\Faking\MockResponse;
use Shove\Data\Job;
use Shove\Data\Queue;
use Shove\Enums\QueueType;
use Shove\Requests\Queues\CreateRequest;
use Shove\Requests\Queues\DeleteRequest;
use Shove\Tests\TestCase;
use Shove\Tests\TestClient;

class JobTest extends TestCase
{
    public function test_can_create_new_job_data_objects()
    {
        $job = new Job(
            queue: 'test_queue',
            headers: ['Content-Type' => 'application/json'],
            body: ['message' => 'Hello, World!']
        );

        $this->assertEquals('test_queue', $job->queue);
        $this->assertEquals(['Content-Type' => 'application/json'], $job->headers);
        $this->assertEquals(['message' => 'Hello, World!'], $job->body);
    }
}