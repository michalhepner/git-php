<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository;

use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Author\QueryBuilder;

class Author
{
    public function __construct(
        protected Repository $repository,
        protected string $name,
        protected string $email,
    ) {}

    public static function all(Repository $repository): AuthorCollection
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

    public function getEmail(): string
    {
        return $this->email;
    }
}
