<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class UnpackObjectsCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'unpack-objects';
    }
}
