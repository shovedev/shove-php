# Shove.dev PHP SDK

The official PHP SDK for the [Shove.dev](https://shove.dev) API. Shove is a cloud message queue service designed to make it easy to work with message queues in your applications.

## Installation

Install the package via Composer:

```bash
composer require shovedev/shove-php
```

## Requirements

- PHP 8.2+
- GuzzleHTTP 7.8+

## Usage

### Initialization

```php
use Shove\Connector\ShoveConnector;

// Initialize the Shove connector with your API token
$shove = new ShoveConnector(
    token: 'your-api-token',
    baseUrl: 'https://shove.dev/api' // Optional, defaults to https://shove.dev/api
);
```

### Working with Queues

Shove supports two types of queues:

- **Unicast**: Traditional queue where each message is delivered to a single consumer
- **Multicast**: Pub/Sub style queue where each message is delivered to all consumers

#### Creating a Queue

```php
use Shove\Enums\QueueType;

// Create a unicast queue
$unicastQueue = $shove->queues()->create(
    name: 'emails',
    type: QueueType::Unicast
);

// Create a multicast queue
$multicastQueue = $shove->queues()->create(
    name: 'notifications',
    type: QueueType::Multicast // or simply 'multicast'
);
```

#### Deleting a Queue

```php
$shove->queues()->delete(name: 'queue-name');
```

### Working with Jobs

Jobs are individual messages that are sent to queues.

#### Creating a Job

```php
// Create a job with a simple body
$response = $shove->jobs()->create(
    queue: 'emails',
    body: [
        'to' => 'user@example.com',
        'subject' => 'Welcome!',
        'content' => 'Welcome to our service!'
    ]
);

// Create a job with custom headers
$response = $shove->jobs()->create(
    queue: 'emails',
    headers: [
        'priority' => 'high',
        'retry-count' => 3
    ],
    body: [
        'to' => 'user@example.com',
        'subject' => 'Password Reset',
        'content' => 'Click here to reset your password.'
    ]
);
```

#### Retrieving a Job

```php
$job = $shove->jobs()->get(id: 'job-id');
```

## Laravel Integration

Shove provides a Laravel package for seamless integration: [shovedev/shove-laravel](https://github.com/shovedev/shove-laravel).

## Response Handling

The SDK returns responses using Saloon's Response object:

```php
$response = $shove->jobs()->create(queue: 'default', body: ['key' => 'value']);

// Check if the request was successful
if ($response->successful()) {
    // Process response data
    $data = $response->json();
}
```

## Error Handling

The SDK will throw exceptions when requests fail:

```php
try {
    $response = $shove->jobs()->create(queue: 'non-existent-queue', body: ['key' => 'value']);
} catch (\RuntimeException $e) {
    // Handle the error
    echo $e->getMessage();
}
```

## License

This SDK is open-sourced software licensed under the [MIT license](LICENSE).
