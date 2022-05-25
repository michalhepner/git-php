<?php

namespace MichalHepner\Git\Infrastructure\Collection;

use ArrayIterator;
use Iterator;

trait ProvidesIterator
{
    public function each(callable $callback): void
    {
        foreach ($this->items as $item) {
            $callback($item);
        }
    }

    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->getArrayCopy());
    }

    abstract public function getArrayCopy(): array;
}
