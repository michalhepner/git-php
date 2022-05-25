<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class RepackCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'repack';
    }
}
