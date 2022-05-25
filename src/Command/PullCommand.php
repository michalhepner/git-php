<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class PullCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'pull';
    }
}
