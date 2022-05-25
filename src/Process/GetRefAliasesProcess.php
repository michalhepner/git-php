<?php

namespace MichalHepner\Git\Process;

class GetRefAliasesProcess extends AbstractProcess
{
    /**
     * @param string $repoPath
     *
     * @return array
     */
    public function run($repoPath)
    {
        $tagsAndHeads = (new GetTagsAndHeadsProcess($this->processFactory))->run($repoPath);
        $commitDescriptions = (new GetRefDescriptionsProcess($this->processFactory))->run($repoPath);

        $aliases = [];
        foreach ($tagsAndHeads as $ref => $alias) {
            !array_key_exists($ref, $aliases) && $aliases[$ref] = [];
            foreach ($alias as $realAlias) {
                $aliases[$ref][] = $realAlias;
            }
        }

        foreach ($commitDescriptions as $ref => $alias) {
            !array_key_exists($ref, $aliases) && $aliases[$ref] = [];
            $aliases[$ref][] = $alias;
        }

        foreach ($aliases as $ref => $refAliases) {
            $aliases[$ref] = array_unique($refAliases);
        }

        return $aliases;
    }
}
