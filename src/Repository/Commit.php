<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository;

use DateTime;
use MichalHepner\Git\Ref;
use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Commit\QueryBuilder;
use MichalHepner\Git\Util\LazyValue;

class Commit implements Ref
{
    protected LazyValue|Author $author;

    public function __construct(
        protected Repository $repository,
        protected string $hash,
        protected DateTime $date,
        protected string $message,
    ) {}

    public static function all(Repository $repository): CommitCollection
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

    public function getRefSpec(): string
    {
        return $this->hash;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getAuthor(): Author
    {
        return $this->author = $this->author instanceof LazyValue ?
            $this->repository->api()->author()->find($this->repository->revList($this->getName(), ['-n1'])) :
            $this->author
        ;
    }

    public function hydrateAuthor(Author|LazyValue $author): void
    {
        $this->author = $author;
    }

//    public function isParentOf(Commit $commit): bool
//    {
//        return in_array($this->getHash(), $commit->getParentsRecursive()->getHashes(), true);
//    }
//
//    public function isChildOf(Commit $commit): bool
//    {
//        return in_array($commit->getHash(), $this->getParentsRecursive()->getHashes(), true);
//    }
//
//    public function getBranches(): BranchCollection
//    {
//        return $this->workingCopy->getCommitBranches($this);
//    }
//
//    public function getTags(): TagCollection
//    {
//        return $this->workingCopy->getCommitTags($this);
//    }
//
//    public function getParents(): CommitCollection
//    {
//        return $this->parents;
//    }
//
//    public function getParentsRecursive(): CommitCollection
//    {
//        $func = function (CommitCollection $collection, &$acc = null) use (&$func) {
//            $acc = $acc ?? new CommitCollection();
//            foreach ($collection as $commit) {
//                $acc->add($commit);
//                $func($commit->getParents(), $acc);
//            }
//
//            return $acc;
//        };
//
//        return $func($this->getParents());
//    }
//
//    public function hasParents(): bool
//    {
//        return !$this->getParents()->isEmpty();
//    }

}
