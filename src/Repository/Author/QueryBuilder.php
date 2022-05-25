<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Author;

use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Author;
use MichalHepner\Git\Repository\AuthorCollection;
use MichalHepner\Git\Repository\Commit;

class QueryBuilder
{
    public function __construct(protected Repository $repository, protected ?Commit $commit = null)
    {}

    public function execute(): AuthorCollection
    {
        $rawAuthors = [];
        $output = $this->repository->revList(options: [
            '--all',
            '--remotes',
            '--pretty="%%H %%ct ___EMAIL*%%ae*EMAIL___ ___AUTHOR*%%an*AUTHOR___"',
        ]);

        $lines = array_values(
            array_filter(
                array_filter(
                    explode(PHP_EOL, $output),
                    fn (string $line) => !str_starts_with($line, 'commit ')
                )
            )
        );

        if ($this->commit) {
            $lines = array_values(array_filter(
                $lines,
                fn (string $line) => str_starts_with($line, $this->commit->getHash())
            ));
        }

        foreach ($lines as $line) {
            $matches = [];
            preg_match('/^([a-f0-9]{40}) ([0-9]+) ___EMAIL\*(.+)\*EMAIL___ ___AUTHOR\*(.+)\*AUTHOR___$/', $line, $matches);

            if (count($matches) == 5) {
                $email = $matches[3];
                $name = $matches[4];
                $rawAuthors[$email.$name] = new Author($this->repository, $name, $email);
            }
        }

        return new AuthorCollection(array_values($rawAuthors));
    }

    public function getCommit(): ?Commit
    {
        return $this->commit;
    }

    public function setCommit(?Commit $commit): void
    {
        $this->commit = $commit;
    }
}
