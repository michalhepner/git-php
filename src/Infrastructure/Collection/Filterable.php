<?php
declare(strict_types=1);

namespace MichalHepner\Git\Infrastructure\Collection;

trait Filterable
{
    /**
     * @param callable $callback
     * @return $this
     */
    public function filter(callable $callback): self
    {
        return new static(array_filter($this->getArrayCopy(), $callback));
    }

    abstract public function __construct(array $items = []);
    abstract public function getArrayCopy(): array;
}
