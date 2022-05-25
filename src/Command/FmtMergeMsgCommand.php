<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class FmtMergeMsgCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'fmt-merge-msg';
    }
}
