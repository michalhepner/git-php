<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Author;

use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Author;
use MichalHepner\Git\Repository\AuthorCollection;
use MichalHepner\Git\Repository\Commit;

class Api
{
    public function __construct(protected Repository $repository)
    {}

    public function all(): AuthorCollection
    {
        return Author::query($this->repository)->execute();
    }

    public function findByCommit(Commit $commit): Author
    {
        $query = Author::query($this->repository);
        $query->setCommit($commit);

        return $query->execute()->first();
    }
}
