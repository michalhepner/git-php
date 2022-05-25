<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class SendEmailCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'send-email';
    }
}
