<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class VerifyCommitCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'verify-commit';
    }
}
