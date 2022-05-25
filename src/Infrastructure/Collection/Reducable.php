<?php
declare(strict_types=1);

namespace MichalHepner\Git\Infrastructure\Collection;

trait Reducable
{
    public function reduce(callable $callback): mixed
    {
        $accumulator = null;
        foreach ($this->getArrayCopy() as $item) {
            $accumulator = $callback($accumulator, $item);
        }

        return $accumulator;
    }

    abstract public function getArrayCopy(): array;
}
