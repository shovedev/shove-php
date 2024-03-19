<?php

namespace Shove\Traits;

use Shove\Resources\Jobs;
use Shove\Resources\Queues;

trait InteractsWithResources
{
    public function queues()
    {
        return new Queues($this);
    }

    public function jobs()
    {
        return new Jobs($this);
    }
}