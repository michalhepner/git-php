<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class MergeOneFileCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'merge-one-file';
    }
}
