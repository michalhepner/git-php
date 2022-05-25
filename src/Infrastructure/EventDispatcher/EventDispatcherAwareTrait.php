<?php
declare(strict_types=1);

namespace MichalHepner\Git\Infrastructure\EventDispatcher;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

trait EventDispatcherAwareTrait
{
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param EventDispatcherInterface $dispatcher
     *
     * @return $this
     */
    public function setDispatcher(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;

        return $this;
    }

    /**
     * @param AbstractEvent $event
     */
    protected function dispatch(AbstractEvent $event)
    {
        $this->dispatcher && $this->dispatcher->dispatch($event);
    }
}
