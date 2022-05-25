<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class FetchPackCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'fetch-pack';
    }
}
