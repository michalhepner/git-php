<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Remote;

use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Remote;
use MichalHepner\Git\Repository\RemoteCollection;

class Api
{
    public function __construct(protected Repository $repository)
    {}

    public function all(): RemoteCollection
    {
        return (new QueryBuilder($this->repository))->execute();
    }

    public function findByName(string $name): ?Remote
    {
        return $this->all()->filter(fn (Remote $remote) => $remote->getName() === $name)->first();
    }
}
