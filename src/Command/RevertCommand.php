<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class RevertCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'revert';
    }
}
