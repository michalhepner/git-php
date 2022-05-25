<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class VarCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'var';
    }
}
