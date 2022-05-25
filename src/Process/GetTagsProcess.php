<?php

namespace MichalHepner\Git\Process;

class GetTagsProcess extends AbstractProcess
{
    public function run(string $repoPath): array
    {
        $rawCmd = 'cd %s && git show-ref';
        $output = $this->runProcess(sprintf($rawCmd, $repoPath));

        return $this->parseOutput($output);
    }

    public function parseOutput(string $output): array
    {
        $aliases = [];
        foreach (explode(PHP_EOL, $output) as $line) {
            $explodedLine = explode(' ', trim($line));
            if (count($explodedLine) > 1) {
                $hash = array_shift($explodedLine);
                if (!isset($aliases[$hash])) {
                    $aliases[$hash] = [];
                }

                $name = implode(' ', $explodedLine);
                if (preg_match('/^refs\/tags\//', $name)) {
                    $name = preg_replace('/^refs\/tags\//', '', $name);
                    $aliases[$hash][] = $name;
                }
            }
        }

        return $aliases;
    }
}
