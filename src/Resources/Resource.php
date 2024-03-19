<?php

namespace Shove\Resources;

use RuntimeException;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Shove\Connector\ShoveConnector;

abstract class Resource
{
    public function __construct(
        protected ShoveConnector $connector,
    ) {
    }

    public function send(Request $request): Response
    {
        $response = $this->connector->send($request);

        if ($response->failed()) {
            throw new RuntimeException('The request could not be completed.');
        }

        return $response;
    }
}