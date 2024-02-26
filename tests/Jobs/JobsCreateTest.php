<?php

namespace Shove\Tests\Jobs;

use Saloon\Http\Faking\MockResponse;
use Shove\JobsCreateRequest;
use Shove\JobsReadRequest;
use Shove\Tests\TestCase;
use Shove\Tests\TestClient;

class JobsCreateTest extends TestCase
{
    use TestClient;

    public function test_can_create_a_new_job_via_api()
    {
        $shove = $this->getConnector([
            JobsCreateRequest::class => MockResponse::make([
                'data' => [
                    'queue' => 'test_queue',
                    'headers' => ['foo' => 'bar'],
                    'payload' => ['boo' => 'baz'],
                ]
            ], 204)
        ]);

        $request = JobsCreateRequest::make(
            queue: 'test_queue',
            headers: ['foo' => 'bar'],
            body: ['boo' => 'baz']
        );

        $response = $shove->send($request);

        $this->assertEquals(204, $response->status());
        $this->assertEquals('test_queue', $response->json('data.queue'));
        $this->assertEquals(['foo' => 'bar'], $response->json('data.headers'));
        $this->assertEquals(['boo' => 'baz'], $response->json('data.payload'));
    }

    public function test_can_check_the_status_of_a_job_via_api()
    {
        $shove = $this->getConnector([
            JobsReadRequest::class => MockResponse::make([
                'data' => [
                    'queue' => 'test_queue',
                    'status' => 'reserved',
                    'headers' => ['foo' => 'bar'],
                    'payload' => ['boo' => 'baz'],
                ]
            ], 204)
        ]);

        $request = JobsReadRequest::make('test-job-id');

        $response = $shove->send($request);

        $this->assertEquals(204, $response->status());
        $this->assertEquals('test_queue', $response->json('data.queue'));
        $this->assertEquals('reserved', $response->json('data.status'));
        $this->assertEquals(['foo' => 'bar'], $response->json('data.headers'));
        $this->assertEquals(['boo' => 'baz'], $response->json('data.payload'));
    }
}