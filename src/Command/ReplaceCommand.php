<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class ReplaceCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'replace';
    }
}
