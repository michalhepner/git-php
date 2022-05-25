<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository;

use MichalHepner\Git\Repository\Tag\QueryBuilder;
use MichalHepner\Git\Util\LazyValue;
use MichalHepner\Git\Ref;
use MichalHepner\Git\Repository;
use Stringable;

class Tag implements Ref, Stringable
{
    protected LazyValue|Commit $commit;

    public function __construct(
        protected Repository $repository,
        protected string $name,
        protected ?string $message = null
    ) {
        $this->commit = new LazyValue();
    }

    public static function all(Repository $repository): TagCollection
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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getCommit(): Commit
    {
        return $this->commit = $this->commit instanceof LazyValue ?
            $this->repository->api()->commit()->find($this->repository->revList($this->getName(), ['-n1'])) :
            $this->commit
        ;
    }

    public function hydrateCommit(Commit|LazyValue $commit): void
    {
        $this->commit = $commit;
    }

    public function getRefSpec(): string
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->name;
    }
}
