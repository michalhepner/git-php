<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Remote;

use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Remote;
use MichalHepner\Git\Repository\RemoteCollection;
use RuntimeException;

class QueryBuilder
{
    public function __construct(protected Repository $repository)
    {}

    public function execute(): RemoteCollection
    {
        $output = $this->repository->remote(options: ['--verbose']);

        $remotes = new RemoteCollection();
        $rawRemotes = [];

        foreach (explode(PHP_EOL, $output) as $line) {
            $matches = [];
            preg_match("/^([^ \t]+){1}[ \t]+([^ \t]+){1}[ ]+\((fetch|push){1}\)$/", trim($line), $matches);

            if (count($matches) !== 4) {
                throw new RuntimeException('Failed to decode output of git remote --verbose command');
            }

            list(, $name, $uri, $uriType) = $matches;

            !array_key_exists($name, $rawRemotes) && $rawRemotes[$name] = [];
            !array_key_exists($uriType, $rawRemotes[$name]) && $rawRemotes[$name][$uriType] = [];
            $rawRemotes[$name][$uriType][] = $uri;
        }

        foreach ($rawRemotes as $name => $data) {
            $remote = new Remote($this->repository, $name);
            foreach (['fetch', 'push'] as $uriType) {
                if (array_key_exists($uriType, $data)) {
                    $uris = new UriCollection();
                    foreach ($data[$uriType] as $uri) {
                        $uris->add(new Uri($uri));
                    }
                    $remote->{'hydrate' . ucfirst($uriType) .'Urls'}($uris);
                }
            }
            $remotes->add($remote);
        }

        return $remotes;
    }
}
