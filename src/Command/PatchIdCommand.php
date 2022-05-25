<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class PatchIdCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'patch-id';
    }
}
