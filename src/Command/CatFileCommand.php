<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class CatFileCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'cat-file';
    }
}
