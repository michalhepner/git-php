<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class GcCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'gc';
    }
}
