<?php

namespace Shove\Tests\Feature\Jobs;

use Saloon\Http\Faking\MockResponse;
use Shove\Requests\Jobs\CreateRequest;
use Shove\Requests\Jobs\ReadRequest;
use Shove\Tests\TestCase;
use Shove\Tests\TestClient;

class JobsTest extends TestCase
{
    use TestClient;

    public function test_can_create_a_new_job_via_api()
    {
        $shove = $this->getConnector([
            CreateRequest::class => MockResponse::fixture('resources/jobs/create')
        ]);

        $response = $shove->jobs()->create(
            queue: 'default',
            headers: ['foo' => 'bar'],
            body: ['boo' => 'baz']
        );

        $this->assertEquals(201, $response->status());
        $this->assertEquals('default', $response->json('data.queue'));
        $this->assertEquals('pending', $response->json('data.status'));
        $this->assertEquals(['foo' => 'bar'], $response->json('data.headers'));
        $this->assertEquals(['boo' => 'baz'], $response->json('data.body'));
    }

    public function test_can_check_the_status_of_a_job_via_api()
    {
        $shove = $this->getConnector([
            CreateRequest::class => MockResponse::fixture('resources/jobs/create'),
            ReadRequest::class => MockResponse::fixture('resources/jobs/read')
        ]);

        // First create a job
        $createResponse = $shove->jobs()->create(
            queue: 'default',
            headers: ['foo' => 'bar'],
            body: ['boo' => 'baz']
        );

        $response = $shove->jobs()->get(
            id: $createResponse->json('data.id')
        );

        $this->assertEquals(200, $response->status());
        $this->assertEquals('default', $response->json('data.queue'));
        $this->assertEquals('pending', $response->json('data.status'));
        $this->assertEquals(['foo' => 'bar'], $response->json('data.headers'));
        $this->assertEquals(['boo' => 'baz'], $response->json('data.body'));
    }
}