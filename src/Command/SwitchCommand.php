<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class SwitchCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'switch';
    }
}
