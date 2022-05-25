<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository;

use MichalHepner\Git\Repository;

class Api
{
    public function __construct(protected Repository $repository)
    {}

    public function commit(): Commit\Api
    {
        return new Commit\Api($this->repository);
    }

    public function tag(): Tag\Api
    {
        return new Tag\Api($this->repository);
    }

    public function branch(): Branch\Api
    {
        return new Branch\Api($this->repository);
    }

    public function remote(): Remote\Api
    {
        return new Remote\Api($this->repository);
    }

    public function file(): File\Api
    {
        return new File\Api($this->repository);
    }
}
