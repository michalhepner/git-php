<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class DifftoolCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'difftool';
    }
}
