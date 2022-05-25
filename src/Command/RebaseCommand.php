<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class RebaseCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'rebase';
    }
}
