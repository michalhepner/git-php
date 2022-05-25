<?php

namespace MichalHepner\Git\Process;

use MichalHepner\Git\Exception\ProcessException;

class BulkDataProcess extends AbstractProcess
{
    /**
     * @param string $repoPath
     *
     * @return array
     *
     * @throws ProcessException
     */
    public function run(string $repoPath): array
    {
        $rawCmd1 = 'cd %s && git rev-list --all --remotes --pretty="%%H %%ct ___EMAIL*%%ae*EMAIL___ ___AUTHOR*%%an*AUTHOR___ ___MESSAGE*%%s*MESSAGE___" | grep -v "^commit"';
        $output1 = $this->runProcess(sprintf($rawCmd1, $repoPath));

        $data = $this->parseOutput1($output1);

        $rawCmd2 = 'cd %s && git rev-list --all --remotes --parents';
        $output2 = $this->runProcess(sprintf($rawCmd2, $repoPath));

        $data2 = $this->parseOutput2($output2);

        foreach ($data as $hash => $item) {
            $data[$hash]['parents'] = $data2[$hash];
        }

        return $data;
    }

    protected function parseOutput1(string $output): array
    {
        $items = [];
        foreach (explode(PHP_EOL, $output) as $line) {
            $matches = null;
            preg_match('/^([a-f0-9]{40}) ([0-9]+) ___EMAIL\*(.+)\*EMAIL___ ___AUTHOR\*(.+)\*AUTHOR___ ___MESSAGE\*(.+)\*MESSAGE___$/', $line, $matches);

            if (count($matches) == 6) {
                $items[$matches[1]] = [
                    'hash' => $matches[1],
                    'date' => (new \DateTime())->setTimestamp((int) $matches[2]),
                    'mail' => $matches[3],
                    'name' => $matches[4],
                    'mssg' => $matches[5],
                ];
            }
        }

        return $items;
    }

    protected function parseOutput2(string $output): array
    {
        $items = [];
        foreach (explode(PHP_EOL, trim($output)) as $line) {
            $tmp = preg_split('/[\t ]/', $line);
            $hash = array_shift($tmp);

            $items[$hash] = $tmp;
        }

        return $items;
    }
}
