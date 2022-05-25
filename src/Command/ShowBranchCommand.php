<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class ShowBranchCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'show-branch';
    }
}
