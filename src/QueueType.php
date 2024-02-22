<?php

namespace Shove;

enum QueueType: string
{
    case Unicast = 'unicast';
    case Multicast = 'multicast';
}
