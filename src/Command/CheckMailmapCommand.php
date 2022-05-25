<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class CheckMailmapCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'check-mailmap';
    }
}
