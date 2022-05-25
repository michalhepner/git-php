<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class CheckIgnoreCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'check-ignore';
    }
}
