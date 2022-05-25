<?php

namespace MichalHepner\Git\Process;

class GetOnBranchesProcess extends AbstractProcess
{
    /**
     * @param string $repoPath
     *
     * @return array
     */
    public function run(string $repoPath): array
    {
        $rawListCmd = 'cd %s && git branch -a --format="%%(refname:lstrip=2)" | grep -v "HEAD detached" | xargs -I zzzz sh -c \'printf $0" "; git rev-list $0 | xargs\' zzzz';
        $rawOutput = $this->runProcess(sprintf($rawListCmd, $repoPath));

        $refs = [];
        foreach (explode(PHP_EOL, $rawOutput) as $line) {
            $lineData = explode(' ', $line);
            $branch = array_shift($lineData);

            if ($branch === 'origin/HEAD' || !preg_match('/^origin\//', $branch)) {
                continue;
            }

            $branch = preg_replace('/^origin\//', '', $branch);

            foreach ($lineData as $ref) {
                if (!array_key_exists($ref, $refs)) {
                    $refs[$ref] = [];
                }
                $refs[$ref][] = $branch;
            }
        }

        return $refs;
    }
}
