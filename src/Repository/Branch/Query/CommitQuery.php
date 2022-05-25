<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Branch\Query;

use MichalHepner\Git\RefCollection;
use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Branch;
use MichalHepner\Git\Repository\Commit;

class CommitQuery
{
    public function __construct(protected Repository $repository, protected Branch $branch)
    {}

    public function execute(): Commit
    {
        $query = Commit::query($this->repository);
        $query->setRefs(new RefCollection([$this->branch]));

        return $query->execute()->first();
    }
}
