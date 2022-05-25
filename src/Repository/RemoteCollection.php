<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository;

use MichalHepner\Git\Infrastructure\Collection\AbstractCollection;

class RemoteCollection extends AbstractCollection
{
    public function getNames(): array
    {
        return $this->map(fn (Remote $remote) => $remote->getName());
    }

    public function has(string $name): bool
    {
        /** @var Remote $item */
        foreach ($this as $item) {
            if ($item->getName() === $name) {
                return true;
            }
        }

        return false;
    }

    public function get(string $name): ?Remote
    {
        /** @var Remote $item */
        foreach ($this as $item) {
            if ($item->getName() === $name) {
                return $item;
            }
        }

        return null;
    }
}
