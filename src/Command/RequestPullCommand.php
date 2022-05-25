<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class RequestPullCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'request-pull';
    }
}
