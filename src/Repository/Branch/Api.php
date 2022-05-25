<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Branch;

use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Branch;
use MichalHepner\Git\Repository\BranchCollection;

class Api
{
    public function __construct(protected Repository $repository)
    {}

    public function all(): BranchCollection
    {
        return Branch::all($this->repository);
    }

    public function find(string $name): ?Branch
    {
    }
}
