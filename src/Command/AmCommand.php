<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class AmCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'am';
    }
}
