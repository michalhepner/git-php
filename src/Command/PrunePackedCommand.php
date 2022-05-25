<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class PrunePackedCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'prune-packed';
    }
}
