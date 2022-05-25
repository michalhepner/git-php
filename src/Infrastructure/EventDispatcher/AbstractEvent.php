<?php

namespace MichalHepner\Git\Infrastructure\EventDispatcher;

use Symfony\Contracts\EventDispatcher\Event;

abstract class AbstractEvent extends Event
{
    /**
     * @return string
     */
    abstract public function getEventName();
}
