<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Commit;

use MichalHepner\Git\Ref;
use MichalHepner\Git\RefCollection;
use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Commit;
use MichalHepner\Git\Repository\CommitCollection;
use MichalHepner\Git\StringRef;

class Api
{
    public function __construct(protected Repository $repository)
    {}

    public function all(): CommitCollection
    {
        return Commit::all($this->repository);
    }

    public function find(Ref|string $ref): ?Commit
    {
        $query = Commit::query($this->repository);
        $query->setRefs(new RefCollection([$ref instanceof Ref ? $ref : new StringRef($ref)]));

        return $query->execute()->first();
    }
}
