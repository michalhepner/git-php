<?php

namespace MichalHepner\Git\Process;

class GetTagsAndHeadsProcess extends AbstractProcess
{
    /**
     * @param string $repoPath
     *
     * @return array
     */
    public function run(string $repoPath): array
    {
        $rawCmd = 'cd %s && git show-ref --heads --tags';
        $output = $this->runProcess(sprintf($rawCmd, $repoPath));

        return $this->parseOutput($output);
    }

    public function parseOutput(string $output): array
    {
        $aliases = [];
        foreach (explode(PHP_EOL, $output) as $line) {
            $explodedLine = explode(' ', $line);
            if (count($explodedLine) > 1) {
                $hash = array_shift($explodedLine);
                if (!isset($aliases[$hash])) {
                    $aliases[$hash] = [];
                }

                $name = implode(' ', $explodedLine);
                $name = preg_replace('/^refs\/heads\/|refs\/tags\//', '', $name);
                $aliases[$hash][] = $name;
            }
        }

        return $aliases;
    }
}
