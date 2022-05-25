<?php
declare(strict_types=1);

namespace MichalHepner\Git\Infrastructure\Collection;

trait Countable
{
    public function count(): int
    {
        return count($this->getArrayCopy());
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    abstract public function getArrayCopy(): array;
}
