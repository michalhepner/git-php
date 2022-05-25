<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class IndexPackCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'index-pack';
    }
}
