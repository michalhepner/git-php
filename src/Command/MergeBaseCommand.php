<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class MergeBaseCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'merge-base';
    }
}
