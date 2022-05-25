<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class MergeFileCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'merge-file';
    }
}
