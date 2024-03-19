<?php

namespace Shove\Enums;

enum QueueType: string
{
    case Unicast = 'unicast';
    case Multicast = 'multicast';
}
