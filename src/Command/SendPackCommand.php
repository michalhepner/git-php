<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class SendPackCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'send-pack';
    }
}
