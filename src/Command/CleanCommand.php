<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class CleanCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'clean';
    }
}
