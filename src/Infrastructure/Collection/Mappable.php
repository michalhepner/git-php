<?php
declare(strict_types=1);

namespace MichalHepner\Git\Infrastructure\Collection;

trait Mappable
{
    public function map(callable $callback): array
    {
        return array_map($callback, $this->getArrayCopy());
    }

    abstract public function getArrayCopy(): array;
}
