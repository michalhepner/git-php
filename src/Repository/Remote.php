<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository;

use MichalHepner\Git\Repository\Remote\Query\UriQuery;
use MichalHepner\Git\Repository\Remote\QueryBuilder;
use MichalHepner\Git\Repository\Remote\UriCollection;
use MichalHepner\Git\Util\LazyValue;
use MichalHepner\Git\Repository;

class Remote
{
    protected LazyValue|UriCollection $fetchUrls;
    protected LazyValue|UriCollection $pushUrls;

    public function __construct(protected Repository $repository, protected string $name)
    {
        $this->refresh();
    }

    public static function all(Repository $repository): RemoteCollection
    {
        return (new QueryBuilder($repository))->execute();
    }

    public function getRepository(): Repository
    {
        return $this->repository;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function hydrateFetchUrls(LazyValue|UriCollection $fetchUrls): void
    {
        $this->fetchUrls = $fetchUrls;
    }

    public function hydratePushUrls(UriCollection|LazyValue $pushUrls): void
    {
        $this->pushUrls = $pushUrls;
    }

    public function getFetchUrls(): UriCollection
    {
        return $this->fetchUrls = $this->fetchUrls instanceof LazyValue ?
            (new UriQuery($this->repository, $this, 'fetch')) :
            $this->fetchUrls
        ;
    }

    public function getPushUrls(): UriCollection
    {
        return $this->pushUrls = $this->fetchUrls instanceof LazyValue ?
            (new UriQuery($this->repository, $this, 'push')) :
            $this->fetchUrls
        ;
    }

    public function getDefaultBranch(): ?Branch
    {
        $output = $this->repository->lsRemote($this->getName(), ['--symref']);

        $matches = [];
        if (preg_match('/^ref: refs\/heads\/([^ \t]+){1}/', $output, $matches)) {
            $branches = $this->repository->api()->branch()->all()->filterRemote($this);

            return $branches->filter(fn (Branch $branch) => $branch->getName() === $matches[1])->first();
        }
    }

    public function refresh(): void
    {
        $this->fetchUrls = new LazyValue();
        $this->pushUrls = new LazyValue();
    }
}
