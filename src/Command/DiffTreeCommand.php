<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class DiffTreeCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'diff-tree';
    }
}
