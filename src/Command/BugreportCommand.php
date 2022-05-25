<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class BugreportCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'bugreport';
    }
}
