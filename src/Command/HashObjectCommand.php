<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class HashObjectCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'hash-object';
    }
}
