<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class CommitTreeCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'commit-tree';
    }
}
