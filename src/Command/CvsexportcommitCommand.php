<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class CvsexportcommitCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'cvsexportcommit';
    }
}
