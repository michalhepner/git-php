<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class GrepCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'grep';
    }
}
