<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class ReadTreeCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'read-tree';
    }
}
