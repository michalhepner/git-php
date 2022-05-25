<?php

declare(strict_types=1);

namespace MichalHepner\Git\Process;

class GetCommitOnBranchProcess extends AbstractProcess
{
    public function run(string $repoPath, string $branchName, string $hash): bool
    {
        $cmd = sprintf('cd %s && git log \'%s\' --pretty="%%H" | grep \'%s\' --color=never || true', $repoPath, $branchName, $hash);
        $output = trim($this->runProcess($cmd));

        return $output === $hash;
    }
}
