<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class VerifyTagCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'verify-tag';
    }
}
