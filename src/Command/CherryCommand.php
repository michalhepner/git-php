<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class CherryCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'cherry';
    }
}
