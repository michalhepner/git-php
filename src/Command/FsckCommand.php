<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class FsckCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'fsck';
    }
}
