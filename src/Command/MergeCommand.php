<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class MergeCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'merge';
    }
}
