<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class ImapSendCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'imap-send';
    }
}
