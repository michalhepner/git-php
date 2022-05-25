<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Tag;

use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Tag;
use MichalHepner\Git\Repository\TagCollection;

class Api
{
    public function __construct(protected Repository $repository)
    {}

    public function all(): TagCollection
    {
        return Tag::all($this->repository);
    }
}
