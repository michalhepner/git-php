<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository;

use MichalHepner\Git\Ref;
use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Branch\Query\CommitQuery;
use MichalHepner\Git\Repository\Branch\QueryBuilder;

class Branch implements Ref
{
    public function __construct(
        protected Repository $repository,
        protected string $name,
        protected ?Remote $remote,
    ) {}

    public static function all(Repository $repository): BranchCollection
    {
        return self::query($repository)->execute();
    }

    public static function query(Repository $repository): QueryBuilder
    {
        return new QueryBuilder($repository);
    }

    public function getRepository(): Repository
    {
        return $this->repository;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRemote(): ?Remote
    {
        return $this->remote;
    }

    public function getFullName(): string
    {
        return $this->isRemote() ?
            $this->getRemote()->getName().'/'.$this->getName() :
            $this->getName()
        ;
    }

    public function getCommit(): Commit
    {
        return (new CommitQuery($this->repository, $this))->execute();
    }

    public function isRemote(?string $remoteName = null): bool
    {
        if ($this->getRemote() === null) {
            return false;
        }

        return empty($remoteName) || $remoteName === $this->getRemote()->getName();
    }

    public function getRefSpec(): string
    {
        return $this->getFullName();
    }
}
