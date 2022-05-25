<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class NameRevCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'name-rev';
    }
}
