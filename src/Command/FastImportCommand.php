<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class FastImportCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'fast-import';
    }
}
