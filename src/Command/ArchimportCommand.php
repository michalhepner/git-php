<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class ArchimportCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'archimport';
    }
}
