<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class DiffFilesCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'diff-files';
    }
}
