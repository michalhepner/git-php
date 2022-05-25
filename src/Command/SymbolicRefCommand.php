<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class SymbolicRefCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'symbolic-ref';
    }
}
