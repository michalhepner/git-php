<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class RestoreCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'restore';
    }
}
