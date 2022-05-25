<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Branch;

use MichalHepner\Git\Repository;
use MichalHepner\Git\Repository\Branch;
use MichalHepner\Git\Repository\BranchCollection;
use MichalHepner\Git\Repository\Remote;

class QueryBuilder
{
    public function __construct(protected Repository $repository)
    {}

    public function execute(): BranchCollection
    {
        $branches = new BranchCollection();
        $output = $this->repository->showRef();
        $lines = array_values(array_filter(explode(PHP_EOL, $output)));
        foreach ($lines as $line) {
            list(, $fullRefName) = explode(' ', $line);
            if (str_starts_with($fullRefName, 'refs/heads/')) {
                $branchName = preg_replace('/^refs\/heads\//', '', $fullRefName);
                $branches->add(new Branch($this->repository, $branchName, null));
            } elseif (str_starts_with($fullRefName, 'refs/remotes/')) {
                $parts = explode('/', preg_replace('/^refs\/remotes\//', '', $fullRefName));
                $remoteName = array_shift($parts);
                $branchName = implode('/', $parts);
                if ($branchName !== 'HEAD') {
                    $branches->add(new Branch($this->repository, $branchName, new Remote($this->repository, $remoteName)));
                }
            }
        }

        return $branches;
    }
}
