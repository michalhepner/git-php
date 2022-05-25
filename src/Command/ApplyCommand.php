<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class ApplyCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'apply';
    }
}
