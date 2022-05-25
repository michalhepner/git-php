<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class CheckRefFormatCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'check-ref-format';
    }
}
