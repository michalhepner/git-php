<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class LsRemoteCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'ls-remote';
    }
}
