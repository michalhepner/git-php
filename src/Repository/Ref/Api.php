<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Ref;

use MichalHepner\Git\Ref;
use MichalHepner\Git\Repository;

class Api
{
    public function __construct(protected Repository $repository)
    {}

    public function getType(string $ref): ?string
    {
//        $output = $this->repository->showRef($ref);
//        if (!empty($output)) {
//            $types = [];
//            foreach (explode(PHP_EOL, $output) as $line) {
//                list (, $fullRefName) = explode(' ', $output);
//                if (preg_match('/^refs\/(heads|remotes){1}\//', $fullRefName)) {
//                    $types[] = Ref::TYPE_BRANCH;
//                } elseif (preg_match('/^refs\/tags\//', ))
//            }
//        }

        return null;
    }
}
