<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Commit;

use DateTime;
use MichalHepner\Git\Ref;
use MichalHepner\Git\RefCollection;
use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Author;
use MichalHepner\Git\Repository\Commit;
use MichalHepner\Git\Repository\CommitCollection;

class QueryBuilder
{
    public function __construct(protected Repository $repository, protected ?RefCollection $refs = null)
    {}

    public function execute(): CommitCollection
    {
        $commits = new CommitCollection();
        $output = $this->repository->revList(options: [
            '--all',
            '--remotes',
            '--pretty="%H %ct ___EMAIL*%ae*EMAIL___ ___AUTHOR*%an*AUTHOR___ ___MESSAGE*%s*MESSAGE___"',
        ]);;

        $lines = array_values(
            array_filter(
                array_filter(
                    explode(PHP_EOL, $output),
                    fn (string $line) => !str_starts_with($line, 'commit ')
                )
            )
        );

        $hashes = [];
        if ($this->refs && !$this->refs->isEmpty()) {
            $hashes = $this->refs->map(fn (Ref $ref) => $this->repository->revParse($ref->getRefSpec()));
        }

        foreach ($lines as $line) {
            $matches = [];
            preg_match('/^"([a-f0-9]{40}) ([0-9]+) ___EMAIL\*(.+)\*EMAIL___ ___AUTHOR\*(.+)\*AUTHOR___ ___MESSAGE\*(.*)\*MESSAGE___"$/', $line, $matches);

            if (count($matches) == 6) {
                $hash = $matches[1];
                if (count($hashes) === 0 || in_array($hash, $hashes)) {
                    $commit = new Commit(
                        $this->repository,
                        $matches[1],
                        (new DateTime())->setTimestamp((int) $matches[2]),
                        $matches[5]
                    );
                    $commit->hydrateAuthor(new Author($this->repository, $matches[4], $matches[3]));
                    $commits->add($commit);
                }
            }
        }

        return $commits;
    }

    public function getRefs(): RefCollection
    {
        return $this->refs;
    }

    public function setRefs(RefCollection $refs): void
    {
        $this->refs = $refs;
    }
}
