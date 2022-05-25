<?php

namespace MichalHepner\Git\Event;

use MichalHepner\Git\Infrastructure\EventDispatcher\AbstractEvent;

class PreCloneRepositoryEvent extends AbstractEvent
{
    const NAME = 'repository.clone_repository.pre';

    /**
     * @var string
     */
    protected $repositoryUri;

    /**
     * PreCloneRepositoryEvent constructor.
     *
     * @param string $repositoryUri
     */
    public function __construct($repositoryUri)
    {
        $this->repositoryUri = $repositoryUri;
    }

    /**
     * Unique name of the event to be dispatched.
     *
     * @return string
     */
    public function getEventName()
    {
        return self::NAME;
    }

    /**
     * @return string
     */
    public function getRepositoryUri()
    {
        return $this->repositoryUri;
    }
}
