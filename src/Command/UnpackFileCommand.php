<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class UnpackFileCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'unpack-file';
    }
}
