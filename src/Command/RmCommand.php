<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class RmCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'rm';
    }
}
