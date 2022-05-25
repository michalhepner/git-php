<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class MailsplitCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'mailsplit';
    }
}
