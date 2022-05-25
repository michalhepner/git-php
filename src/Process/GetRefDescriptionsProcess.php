<?php

namespace MichalHepner\Git\Process;

class GetRefDescriptionsProcess extends AbstractProcess
{
    /**
     * @param string $repoPath
     *
     * @return array
     */
    public function run(string $repoPath): array
    {
        $rawListCmd = 'cd %s && git rev-list --all --remotes | sort -u';
        $rawListOutput = trim($this->runProcess(sprintf($rawListCmd, $repoPath)));

        $descriptionListCmd = $rawListCmd.' | xargs git describe --tags --always --all';
        $descriptionListOutput = trim($this->runProcess(sprintf($descriptionListCmd, $repoPath)));

        $refs = explode(PHP_EOL, $rawListOutput);
        $refDescriptions = explode(PHP_EOL, $descriptionListOutput);

        $aliases = array_combine($refs, $refDescriptions);
        $regex = '/^remotes\/origin\/|tags\/|heads\//';
        foreach ($aliases as $ref => $refDescription) {
            $aliases[$ref] = trim(preg_replace($regex, '', $refDescription));
        }

        return $aliases;
    }
}
