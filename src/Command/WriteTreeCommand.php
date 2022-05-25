<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class WriteTreeCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'write-tree';
    }
}
