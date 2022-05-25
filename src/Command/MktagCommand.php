<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class MktagCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'mktag';
    }
}
