<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class DiffIndexCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'diff-index';
    }
}
