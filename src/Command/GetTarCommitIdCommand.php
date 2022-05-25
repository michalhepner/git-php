<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class GetTarCommitIdCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'get-tar-commit-id';
    }
}
