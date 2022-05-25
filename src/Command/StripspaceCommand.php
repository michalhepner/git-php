<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class StripspaceCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'stripspace';
    }
}
