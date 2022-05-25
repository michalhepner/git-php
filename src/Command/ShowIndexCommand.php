<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class ShowIndexCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'show-index';
    }
}
