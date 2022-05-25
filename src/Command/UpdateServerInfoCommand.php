<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class UpdateServerInfoCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'update-server-info';
    }
}
