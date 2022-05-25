<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Remote\Query;

use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Remote;
use MichalHepner\Git\Repository\Remote\Uri;
use MichalHepner\Git\Repository\Remote\UriCollection;
use RuntimeException;

class UriQuery
{
    public function __construct(protected Repository $repository, protected Remote $remote, protected string $type)
    {}

    public function execute(): UriCollection
    {
        $output = $this->repository->remote(options: ['--verbose']);

        $uris = new UriCollection();
        foreach (explode(PHP_EOL, $output) as $line) {
            $matches = [];
            preg_match("/^([^ \t]+){1}[ \t]+([^ \t]+){1}[ ]+\((fetch|push){1}\)$/", trim($line), $matches);

            if (count($matches) !== 4) {
                throw new RuntimeException('Failed to decode output of git remote --verbose command');
            }

            list(, $name, $uri, $uriType) = $matches;

            if ($name !== $this->remote->getName() || $uriType !== $this->type) {
                continue;
            }

            $uris->add(new Uri($uri));
        }

        return $uris;
    }
}
