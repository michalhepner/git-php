<?php
declare(strict_types=1);

namespace MichalHepner\Git\Infrastructure\Collection;

trait Sortable
{
    public function usort(callable $callback): void
    {
        $arr = &$this->getArrayReference();
        usort($arr, $callback);
    }

    public function uasort(callable $callback): void
    {
        $array = &$this->getArrayReference();
        uasort($array, $callback);
    }

    abstract protected function &getArrayReference(): array;
}
